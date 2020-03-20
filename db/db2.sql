/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     20/03/2020 13:40:44                          */
/*==============================================================*/


drop table if exists DETAIL_PEMESANAN;

drop table if exists DOMBA;

drop table if exists JABATAN;

drop table if exists JENIS_DOMBA;

drop table if exists KOTA;

drop table if exists PEGAWAI;

drop table if exists PELANGGAN;

drop table if exists PEMBAYARAN;

drop table if exists PEMESANAN;

drop table if exists PENGIRIMAN;

drop table if exists PROVINSI;

/*==============================================================*/
/* Table: DETAIL_PEMESANAN                                      */
/*==============================================================*/
create table DETAIL_PEMESANAN
(
   ID_DOMBA             char(5) not null,
   ID_PEMESANAN         char(5) not null,
   JML_PEMESANAN        numeric(5,0) not null,
   HARGAD               numeric(12,0) not null,
   BERAT_BELI           numeric(5,0) not null,
   primary key (ID_DOMBA, ID_PEMESANAN)
);

/*==============================================================*/
/* Table: DOMBA                                                 */
/*==============================================================*/
create table DOMBA
(
   ID_DOMBA             char(5) not null,
   ID_JENIS             char(5) not null,
   JENIS_KELAMIN        smallint not null,
   HARGA                numeric(12,0) not null,
   BERAT                numeric(5,0) not null,
   primary key (ID_DOMBA)
);

/*==============================================================*/
/* Table: JABATAN                                               */
/*==============================================================*/
create table JABATAN
(
   ID_JABATAN           char(5) not null,
   NAMA_JABATAN         varchar(20) not null,
   primary key (ID_JABATAN)
);

/*==============================================================*/
/* Table: JENIS_DOMBA                                           */
/*==============================================================*/
create table JENIS_DOMBA
(
   ID_JENIS             char(5) not null,
   JENIS_DOMBA          varchar(20) not null,
   primary key (ID_JENIS)
);

/*==============================================================*/
/* Table: KOTA                                                  */
/*==============================================================*/
create table KOTA
(
   ID_KOTA              char(5) not null,
   ID_PROV              char(5) not null,
   NAMA_KOTA            varchar(50) not null,
   primary key (ID_KOTA)
);

/*==============================================================*/
/* Table: PEGAWAI                                               */
/*==============================================================*/
create table PEGAWAI
(
   ID_PEGAWAI           char(5) not null,
   ID_JABATAN           char(5) not null,
   ID_KOTA              char(5) not null,
   NAMA_PEGAWAI         varchar(30) not null,
   ALAMAT_PEGAWAI       varchar(30) not null,
   KODEPOS_PEGAWAI      char(5) not null,
   USERNAME             varchar(15) not null,
   PASSWORD             varchar(15) not null,
   primary key (ID_PEGAWAI)
);

/*==============================================================*/
/* Table: PELANGGAN                                             */
/*==============================================================*/
create table PELANGGAN
(
   ID_PELANGGAN         char(5) not null,
   ID_KOTA              char(5) not null,
   NAMA_PELANGGAN       varchar(30) not null,
   TELP_PELANGGAN       varchar(13) not null,
   ALAMAT_PELANGGAN     varchar(30) not null,
   KODEPOS_PELANGGAN    char(5) not null,
   primary key (ID_PELANGGAN)
);

/*==============================================================*/
/* Table: PEMBAYARAN                                            */
/*==============================================================*/
create table PEMBAYARAN
(
   ID_PEMBAYARAN        char(5) not null,
   ID_PEGAWAI           char(5) not null,
   ID_PEMESANAN         char(5) not null,
   TGL_PEMBAYARAN       timestamp not null,
   TOTAL_PEMBAYARAN     numeric(12,0) not null,
   STATUS_PEMBAYARAN    varchar(50) not null,
   primary key (ID_PEMBAYARAN)
);

/*==============================================================*/
/* Table: PEMESANAN                                             */
/*==============================================================*/
create table PEMESANAN
(
   ID_PEMESANAN         char(5) not null,
   ID_PELANGGAN         char(5) not null,
   ID_KOTA              char(5) not null,
   ID_PEGAWAI           char(5) not null,
   NAMA_PENERIMA        varchar(30),
   ALAMAT_PENERIMA      varchar(30),
   KODEPOS_PENERIMA     char(5),
   JASA_KURIR           varchar(15),
   LAYANAN_KURIR        varchar(50),
   TGL_PESAN            timestamp not null,
   JENIS_BAYAR          varchar(50) not null,
   ONGKOS_KIRIM         numeric(12,0) not null,
   TOTAL_HARGA          numeric(12,0) not null,
   STATUS_TRANSAKSI     varchar(50) not null,
   primary key (ID_PEMESANAN)
);

/*==============================================================*/
/* Table: PENGIRIMAN                                            */
/*==============================================================*/
create table PENGIRIMAN
(
   NO_RESI              char(15) not null,
   ID_PEGAWAI           char(5) not null,
   ID_PEMBAYARAN        char(5) not null,
   TGL_PENGIRIMAN       timestamp not null,
   STATUS_PENGIRIMAN    numeric(1,0) not null,
   primary key (NO_RESI)
);

/*==============================================================*/
/* Table: PROVINSI                                              */
/*==============================================================*/
create table PROVINSI
(
   ID_PROV              char(5) not null,
   NAMA_PROV            varchar(50) not null,
   primary key (ID_PROV)
);

alter table DETAIL_PEMESANAN add constraint FK_TERDAPAT foreign key (ID_DOMBA)
      references DOMBA (ID_DOMBA) on delete restrict on update restrict;

alter table DETAIL_PEMESANAN add constraint FK_TERDIRI1 foreign key (ID_PEMESANAN)
      references PEMESANAN (ID_PEMESANAN) on delete restrict on update restrict;

alter table DOMBA add constraint FK_TERDIRI5 foreign key (ID_JENIS)
      references JENIS_DOMBA (ID_JENIS) on delete restrict on update restrict;

alter table KOTA add constraint FK_RELATIONSHIP_11 foreign key (ID_PROV)
      references PROVINSI (ID_PROV) on delete restrict on update restrict;

alter table PEGAWAI add constraint FK_MENJABAT foreign key (ID_JABATAN)
      references JABATAN (ID_JABATAN) on delete restrict on update restrict;

alter table PEGAWAI add constraint FK_RELATIONSHIP_14 foreign key (ID_KOTA)
      references KOTA (ID_KOTA) on delete restrict on update restrict;

alter table PELANGGAN add constraint FK_RELATIONSHIP_13 foreign key (ID_KOTA)
      references KOTA (ID_KOTA) on delete restrict on update restrict;

alter table PEMBAYARAN add constraint FK_MELAKUKAN5 foreign key (ID_PEMESANAN)
      references PEMESANAN (ID_PEMESANAN) on delete restrict on update restrict;

alter table PEMBAYARAN add constraint FK_MENANGANI1 foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI) on delete restrict on update restrict;

alter table PEMESANAN add constraint FK_MELAKUKAN1 foreign key (ID_PELANGGAN)
      references PELANGGAN (ID_PELANGGAN) on delete restrict on update restrict;

alter table PEMESANAN add constraint FK_MENANGANI foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI) on delete restrict on update restrict;

alter table PEMESANAN add constraint FK_RELATIONSHIP_12 foreign key (ID_KOTA)
      references KOTA (ID_KOTA) on delete restrict on update restrict;

alter table PENGIRIMAN add constraint FK_MELAKUKAN foreign key (ID_PEMBAYARAN)
      references PEMBAYARAN (ID_PEMBAYARAN) on delete restrict on update restrict;

alter table PENGIRIMAN add constraint FK_MENANGANI2 foreign key (ID_PEGAWAI)
      references PEGAWAI (ID_PEGAWAI) on delete restrict on update restrict;

