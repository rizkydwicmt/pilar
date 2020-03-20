/*==============================================================*/
/* DBMS name:      ORACLE Version 10g                           */
/* Created on:     20/03/2020 13:35:10                          */
/*==============================================================*/


alter table DETAIL_PEMESANAN
   drop constraint FK_DETAIL_P_TERDAPAT_DOMBA;

alter table DETAIL_PEMESANAN
   drop constraint FK_DETAIL_P_TERDIRI1_PEMESANA;

alter table DOMBA
   drop constraint FK_DOMBA_TERDIRI5_JENIS_DO;

alter table KOTA
   drop constraint FK_KOTA_RELATIONS_PROVINSI;

alter table PEGAWAI
   drop constraint FK_PEGAWAI_MENJABAT_JABATAN;

alter table PEGAWAI
   drop constraint FK_PEGAWAI_RELATIONS_KOTA;

alter table PELANGGAN
   drop constraint FK_PELANGGA_RELATIONS_KOTA;

alter table PEMBAYARAN
   drop constraint FK_PEMBAYAR_MELAKUKAN_PEMESANA;

alter table PEMBAYARAN
   drop constraint FK_PEMBAYAR_MENANGANI_PEGAWAI;

alter table PEMESANAN
   drop constraint FK_PEMESANA_MELAKUKAN_PELANGGA;

alter table PEMESANAN
   drop constraint FK_PEMESANA_MENANGANI_PEGAWAI;

alter table PEMESANAN
   drop constraint FK_PEMESANA_RELATIONS_KOTA;

alter table PENGIRIMAN
   drop constraint FK_PENGIRIM_MELAKUKAN_PEMBAYAR;

alter table PENGIRIMAN
   drop constraint FK_PENGIRIM_MENANGANI_PEGAWAI;

drop index TERDIRI1_FK;

drop index TERDAPAT_FK;

drop table DETAIL_PEMESANAN cascade constraints;

drop index TERDIRI5_FK;

drop table DOMBA cascade constraints;

drop table JABATAN cascade constraints;

drop table JENIS_DOMBA cascade constraints;

drop index RELATIONSHIP_11_FK;

drop table KOTA cascade constraints;

drop index RELATIONSHIP_14_FK;

drop index MENJABAT_FK;

drop table PEGAWAI cascade constraints;

drop index RELATIONSHIP_13_FK;

drop table PELANGGAN cascade constraints;

drop index MENANGANI1_FK;

drop index MELAKUKAN5_FK;

drop table PEMBAYARAN cascade constraints;

drop index RELATIONSHIP_12_FK;

drop index MELAKUKAN1_FK;

drop index MENANGANI_FK;

drop table PEMESANAN cascade constraints;

drop index MELAKUKAN_FK;

drop index MENANGANI2_FK;

drop table PENGIRIMAN cascade constraints;

drop table PROVINSI cascade constraints;

/*==============================================================*/
/* Table: DETAIL_PEMESANAN                                      */
/*==============================================================*/
create table DETAIL_PEMESANAN  (
   ID_DOMBA             CHAR(5)                         not null,
   ID_PEMESANAN         CHAR(5)                         not null,
   JML_PEMESANAN        NUMBER(5)                       not null,
   HARGAD               NUMBER(12)                      not null,
   BERAT_BELI           NUMBER(5)                       not null,
   constraint PK_DETAIL_PEMESANAN primary key (ID_DOMBA, ID_PEMESANAN)
);

/*==============================================================*/
/* Index: TERDAPAT_FK                                           */
/*==============================================================*/
create index TERDAPAT_FK on DETAIL_PEMESANAN (
   ID_DOMBA ASC
);

/*==============================================================*/
/* Index: TERDIRI1_FK                                           */
/*==============================================================*/
create index TERDIRI1_FK on DETAIL_PEMESANAN (
   ID_PEMESANAN ASC
);

/*==============================================================*/
/* Table: DOMBA                                                 */
/*==============================================================*/
create table DOMBA  (
   ID_DOMBA             CHAR(5)                         not null,
   ID_JENIS             CHAR(5)                         not null,
   JENIS_KELAMIN        SMALLINT                        not null,
   HARGA                NUMBER(12)                      not null,
   BERAT                NUMBER(5)                       not null,
   constraint PK_DOMBA primary key (ID_DOMBA)
);

/*==============================================================*/
/* Index: TERDIRI5_FK                                           */
/*==============================================================*/
create index TERDIRI5_FK on DOMBA (
   ID_JENIS ASC
);

/*==============================================================*/
/* Table: JABATAN                                               */
/*==============================================================*/
create table JABATAN  (
   ID_JABATAN           CHAR(5)                         not null,
   NAMA_JABATAN         VARCHAR2(20)                    not null,
   constraint PK_JABATAN primary key (ID_JABATAN)
);

/*==============================================================*/
/* Table: JENIS_DOMBA                                           */
/*==============================================================*/
create table JENIS_DOMBA  (
   ID_JENIS             CHAR(5)                         not null,
   JENIS_DOMBA          VARCHAR2(20)                    not null,
   constraint PK_JENIS_DOMBA primary key (ID_JENIS)
);

/*==============================================================*/
/* Table: KOTA                                                  */
/*==============================================================*/
create table KOTA  (
   ID_KOTA              CHAR(5)                         not null,
   ID_PROV              CHAR(5)                         not null,
   NAMA_KOTA            VARCHAR2(50)                    not null,
   constraint PK_KOTA primary key (ID_KOTA)
);

/*==============================================================*/
/* Index: RELATIONSHIP_11_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_11_FK on KOTA (
   ID_PROV ASC
);

/*==============================================================*/
/* Table: PEGAWAI                                               */
/*==============================================================*/
create table PEGAWAI  (
   ID_PEGAWAI           CHAR(5)                         not null,
   ID_JABATAN           CHAR(5)                         not null,
   ID_KOTA              CHAR(5)                         not null,
   NAMA_PEGAWAI         VARCHAR2(30)                    not null,
   ALAMAT_PEGAWAI       VARCHAR2(30)                    not null,
   KODEPOS_PEGAWAI      CHAR(5)                         not null,
   USERNAME             VARCHAR2(15)                    not null,
   PASSWORD             VARCHAR2(15)                    not null,
   constraint PK_PEGAWAI primary key (ID_PEGAWAI)
);

/*==============================================================*/
/* Index: MENJABAT_FK                                           */
/*==============================================================*/
create index MENJABAT_FK on PEGAWAI (
   ID_JABATAN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_14_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_14_FK on PEGAWAI (
   ID_KOTA ASC
);

/*==============================================================*/
/* Table: PELANGGAN                                             */
/*==============================================================*/
create table PELANGGAN  (
   ID_PELANGGAN         CHAR(5)                         not null,
   ID_KOTA              CHAR(5)                         not null,
   NAMA_PELANGGAN       VARCHAR2(30)                    not null,
   TELP_PELANGGAN       VARCHAR2(13)                    not null,
   ALAMAT_PELANGGAN     VARCHAR2(30)                    not null,
   KODEPOS_PELANGGAN    CHAR(5)                         not null,
   constraint PK_PELANGGAN primary key (ID_PELANGGAN)
);

/*==============================================================*/
/* Index: RELATIONSHIP_13_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_13_FK on PELANGGAN (
   ID_KOTA ASC
);

/*==============================================================*/
/* Table: PEMBAYARAN                                            */
/*==============================================================*/
create table PEMBAYARAN  (
   ID_PEMBAYARAN        CHAR(5)                         not null,
   ID_PEGAWAI           CHAR(5)                         not null,
   ID_PEMESANAN         CHAR(5)                         not null,
   TGL_PEMBAYARAN       TIMESTAMP                       not null,
   TOTAL_PEMBAYARAN     NUMBER(12)                      not null,
   STATUS_PEMBAYARAN    VARCHAR2(50)                    not null,
   constraint PK_PEMBAYARAN primary key (ID_PEMBAYARAN)
);

/*==============================================================*/
/* Index: MELAKUKAN5_FK                                         */
/*==============================================================*/
create index MELAKUKAN5_FK on PEMBAYARAN (
   ID_PEMESANAN ASC
);

/*==============================================================*/
/* Index: MENANGANI1_FK                                         */
/*==============================================================*/
create index MENANGANI1_FK on PEMBAYARAN (
   ID_PEGAWAI ASC
);

/*==============================================================*/
/* Table: PEMESANAN                                             */
/*==============================================================*/
create table PEMESANAN  (
   ID_PEMESANAN         CHAR(5)                         not null,
   ID_PELANGGAN         CHAR(5)                         not null,
   ID_KOTA              CHAR(5)                         not null,
   ID_PEGAWAI           CHAR(5)                         not null,
   NAMA_PENERIMA        VARCHAR2(30),
   ALAMAT_PENERIMA      VARCHAR2(30),
   KODEPOS_PENERIMA     CHAR(5),
   JASA_KURIR           VARCHAR2(15),
   LAYANAN_KURIR        VARCHAR2(50),
   TGL_PESAN            TIMESTAMP                       not null,
   JENIS_BAYAR          VARCHAR2(50)                    not null,
   ONGKOS_KIRIM         NUMBER(12)                      not null,
   TOTAL_HARGA          NUMBER(12)                      not null,
   STATUS_TRANSAKSI     VARCHAR2(50)                    not null,
   constraint PK_PEMESANAN primary key (ID_PEMESANAN)
);

/*==============================================================*/
/* Index: MENANGANI_FK                                          */
/*==============================================================*/
create index MENANGANI_FK on PEMESANAN (
   ID_PEGAWAI ASC
);

/*==============================================================*/
/* Index: MELAKUKAN1_FK                                         */
/*==============================================================*/
create index MELAKUKAN1_FK on PEMESANAN (
   ID_PELANGGAN ASC
);

/*==============================================================*/
/* Index: RELATIONSHIP_12_FK                                    */
/*==============================================================*/
create index RELATIONSHIP_12_FK on PEMESANAN (
   ID_KOTA ASC
);

/*==============================================================*/
/* Table: PENGIRIMAN                                            */
/*==============================================================*/
create table PENGIRIMAN  (
   NO_RESI              CHAR(15)                        not null,
   ID_PEGAWAI           CHAR(5)                         not null,
   ID_PEMBAYARAN        CHAR(5)                         not null,
   TGL_PENGIRIMAN       TIMESTAMP                       not null,
   STATUS_PENGIRIMAN    NUMBER(1)                       not null,
   constraint PK_PENGIRIMAN primary key (NO_RESI)
);

/*==============================================================*/
/* Index: MENANGANI2_FK                                         */
/*==============================================================*/
create index MENANGANI2_FK on PENGIRIMAN (
   ID_PEGAWAI ASC
);

/*==============================================================*/
/* Index: MELAKUKAN_FK                                          */
/*==============================================================*/
create index MELAKUKAN_FK on PENGIRIMAN (
   ID_PEMBAYARAN ASC
);

/*==============================================================*/
/* Table: PROVINSI                                              */
/*==============================================================*/
create table PROVINSI  (
   ID_PROV              CHAR(5)                         not null,
   NAMA_PROV            VARCHAR2(50)                    not null,
   constraint PK_PROVINSI primary key (ID_PROV)
);

alter table DETAIL_PEMESANAN
   add constraint FK_DETAIL_P_TERDAPAT_DOMBA foreign key (ID_DOMBA)
      references DOMBA (ID_DOMBA);

alter table DETAIL_PEMESANAN
   add constraint FK_DETAIL_P_TERDIRI1_PEMESANA foreign key (ID_PEMESANAN)
      references PEMESANAN (ID_PEMESANAN);

alter table DOMBA
   add constraint FK_DOMBA_TERDIRI5_JENIS_DO foreign key (ID_JENIS)
      references JENIS_DOMBA (ID_JENIS);

alter table KOTA
   add constraint FK_KOTA_RELATIONS_PROVINSI foreign key (ID_PROV)
      references PROVINSI (ID_PROV);

alter table PEGAWAI
   add constraint FK_PEGAWAI_MENJABAT_JABATAN foreign key (ID_JABATAN)
      references JABATAN (ID_JABATAN);

alter table PEGAWAI
   add constraint FK_PEGAWAI_RELATIONS_KOTA foreign key (ID_KOTA)
      references KOTA (ID_KOTA);

alter table PELANGGAN
   add constraint FK_PELANGGA_RELATIONS_KOTA foreign key (ID_KOTA)
      references KOTA (ID_KOTA);

alter table PEMBAYARAN
   add constraint FK_PEMBAYAR_MELAKUKAN_PEMESANA foreign key (ID_PEMESANAN)
      references PEMESANAN (ID_PEMESANAN);

alter table PEMBAYARAN
   add constraint FK_PEMBAYAR_MENANGANI_PEGAWAI foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI);

alter table PEMESANAN
   add constraint FK_PEMESANA_MELAKUKAN_PELANGGA foreign key (ID_PELANGGAN)
      references PELANGGAN (ID_PELANGGAN);

alter table PEMESANAN
   add constraint FK_PEMESANA_MENANGANI_PEGAWAI foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI);

alter table PEMESANAN
   add constraint FK_PEMESANA_RELATIONS_KOTA foreign key (ID_KOTA)
      references KOTA (ID_KOTA);

alter table PENGIRIMAN
   add constraint FK_PENGIRIM_MELAKUKAN_PEMBAYAR foreign key (ID_PEMBAYARAN)
      references PEMBAYARAN (ID_PEMBAYARAN);

alter table PENGIRIMAN
   add constraint FK_PENGIRIM_MENANGANI_PEGAWAI foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI);

