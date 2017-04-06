-- 创建数据库
create database blog;

-- 创建日志表
create table blog(
id smallint(1) unsigned auto_increment,
title varchar(30) not null default '',
content blob not null default '',
comment_num tinyint(1) unsigned not null default 0,
category varchar(15) not null default '',
label varchar(15) not null default '',
author varchar(5) not null default '',
add_time int(15) unsigned not null default 0,
mod_time int(15) unsigned not null default 0,
ding tinyint(1) unsigned not null default 0,
cai tinyint(1) unsigned not null default 0,
primary key(id),
index(id,title,content(255),comment_num),
index(category,title),
index(label,title)
)engine myisam charset utf8;

-- 创建栏目表
create table cate(
id tinyint(1) unsigned auto_increment,
cate_name varchar(15) not null default '',
text_num tinyint(1) unsigned not null default 0,
primary key(id),
index(cate_name,text_num),
index(id,cate_name)
)engine myisam charset utf8;

-- 创建用户表
create table bloguser(
id tinyint(1) unsigned auto_increment,
user_name varchar(15) not null default '',
password char(32) not null default '',
email varchar(20) not null default '',
touxiang varchar(30) not null default '',
add_time int(1) unsigned not null default 0,
last_login int(1) unsigned not null default 0,
primary key(id),
index(id,user_name,touxiang)
)engine myisam charset utf8;

-- 创建评论表
create table comment(
id smallint(1) unsigned auto_increment,
user_id tinyint(1) unsigned not null default 0,
blog_id smallint(1) unsigned not null default 0,
content varchar(300) not null default '',
add_time int(15) unsigned not null default 0,
ding tinyint(1) unsigned not null default 0,
cai tinyint(1) unsigned not null default 0,
huifu_id smallint(1) unsigned not null default 0,
primary key(id),
index(blog_id,content),
index(add_time,content)
)engine myisam charset utf8;

-- 创建留言表
create table liuyan(
id smallint(1) unsigned auto_increment,
user_id tinyint(1) unsigned not null default 0,
content varchar(30) not null default '',
ding tinyint(1) unsigned not null default 0,
cai tinyint(1) unsigned not null default 0,
huifu_id smallint(1) unsigned not null default 0,
primary key(id),
index(user_id,content),
index(content,user_id)
)engine myisam charset utf8;

-- 创建用户_评论操作表
create table commentcaozuo(
id smallint(1) unsigned auto_increment,
user_id tinyint(1) unsigned not null default 0,
comment_id smallint(1) unsigned not null default 0,
ding tinyint(1) unsigned not null default 0,
cai tinyint(1) unsigned not null default 0,
primary key(id),
index(user_id,ding,cai),
index(comment_id,user_id)
)engine myisam charset utf8;

-- 创建用户_留言操作表
create table liuyancaozuo(
id smallint(1) unsigned auto_increment,
user_id tinyint(1) unsigned not null default 0,
liuyan_id smallint(1) unsigned not null default 0,
ding tinyint(1) unsigned not null default 0,
cai tinyint(1) unsigned not null default 0,
primary key(id),
index(user_id,ding,cai),
index(liuyan_id,user_id)
)engine myisam charset utf8;

