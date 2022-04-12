## SPOILY - スポイリー 
**頑張った自分を甘やかすごほうびご飯を共有するSNSアプリ**

### アプリ概要（ここの文章、要改良）
他の人のご褒美ご飯を見るのは自分へのご褒美の幅がめちゃくちゃに広がっていいとされており、
自分では思いつかないような発見が得られ、ご褒美ご飯の満足度がぶち上がりし、QOLがマッハになることが間違いなし。
I should spoil myself! 自分にご褒美あげなくちゃ！って英文のspoilを伸ばして、「**SPOILY**」というアプリを開発しました。

### 想定されたユーザー
- ご褒美ご飯にマンネリが出てきてるユーザー。
- 他の人がどんなご褒美ご飯を食べているのか知りたいユーザー。

### ユーザーが持つ課題（ここの文章、要改良）
自分以外の人がどんなご褒美ご飯を食べているかを知りたい。人のご飯を見るの楽しい。


### 課題の解決方法（このサービスでどうやって解決するか）（ここの文章、要改良）
ごほうびご飯を共有するサイトを使うことで新しいご褒美ご飯を知り、食べることができる


### 使用技術
- フロントエンド
  - HTML 
  - CSS
  - Sass
  - MDBootstrap
  - Vue.js 2.6.14
  - jQuery

- バックエンド
  - PHP 7.4.1-fpm
  - Laravel 6.20.1
  - Composer 2.0.14
  - PHPUnit

- インフラ
  - CircleCi
  - Docker 20.10.8/docker-compose 1.29.2
  - nginx 1.18-alpine
  - MySQL 5.7
  - AWS(EC2, ALB, ACM, S3, RDS, CodeDeploy, SNS, Chatbot, CloudFormation, Route53, VPC, EIP, IAM)


## AWS構成図


## 機能一覧
- **アカウント**
  - アカウント登録
  - アカウント編集
  - アカウント退会（未実装）
  - ログイン・ログアウト
  - フォロー・フォロワー機能

- **投稿機能**
  - ごほうびご飯レシピ登録
  - ごほうびご飯レシピ編集
  - ごほうびご飯レシピ削除
  - ごほうびご飯レシピ詳細
  - ごほうびご飯レシピ一覧（全投稿一覧、My投稿一覧）
  - いいね機能
  - 投稿に対するコメント機能
  - コメント一覧
  - 投稿に対するタグ付け機能
  - 投稿に対するカテゴリ機能
  
- **検索機能**
  - 投稿に対するあいまい検索機能（タイトルと本文が対象）
  - カテゴリ検索機能
  - 投稿とカテゴリを選択した複合検索
  - タグ検索機能（タグをクリックすることで指定したタグに紐付く投稿の一覧を表示）

## DB設計

**ER図**

### 各テーブルについて
| テーブル名 | 説明 |
|:-:|:-:|
| users  | 一般ユーザー情報  |
| admins  | 管理者ユーザー情報（未実装）  |
| relationship | フォロー中/フォロワーのユーザー情報  |
| recipes  | ユーザー投稿の情報  |
| tags  | ユーザー投稿のタグ情報  |
| recipes_tags  | recipeとtagsの中間テーブル  |
| category  | ユーザー投稿のcategory情報  |
| recipes_category  | recipeとcategoryの中間テーブル  |
| likes  | 投稿への、いいねの情報  |
| comments  | ユーザー投稿への、コメントの情報  |
| notifications  | 投稿やフォローされた際の通知情報を管理する  |