FROM php:8.1-rc-apache

ENV TZ Asia/Tokyo

RUN apt-get update && apt-get install -y vim libpq-dev
#apt-get update: パッケージリストを更新して、インストール可能なソフトウェアの最新バージョン情報を取得します。
#apt-get install -y vim libpq-dev: vim（テキストエディタ）とlibpq-dev（PostgreSQLの開発用ライブラリ）をインストールします。
#-yオプションは、すべての確認メッセージに自動で「Yes」と答えるためのものです。
RUN docker-php-ext-install pdo
#docker-php-ext-install: PHPの拡張機能をコンパイルしてインストールするためのコマンドです。
RUN docker-php-ext-install pdo_pgsql

RUN docker-php-ext-install pgsql
