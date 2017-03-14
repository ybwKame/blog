-- 创建数据库
create database blog;

-- 创建日志表
create table blog(
id int(10) auto_increment primary key,
title varchar(30) not null default '',
content varchar(500) not null default '',
comment varchar(50) not null default '',
category varchar(30) not null default '',
label varchar(30) not null default '',
author varchar(20) not null default '',
add_time int(15) not null default 0,
mod_time int(15) not null default 0
)engine myisam charset utf8;