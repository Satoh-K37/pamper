## SPOILY - スポイリー -
**頑張った自分を甘やかすごほうびご飯を共有するサービス**

URL: https://spoily.link/login

### アプリ概要
コンセプトは、
シェアされたご褒美ごはんを見ることで自分へのご褒美のQOLを向上させる
甘やかすという意味の「spoil」を少し変えて、「**SPOILY**」というサービスを開発しました。

投稿、コメント、いいね、フォロー機能のあるSNSサービスです。
カテゴリやタグ付けした投稿のTLや検索機能によって自分のご褒美ごはんの幅を広げることを目的にしたサービスです。

### 想定されたユーザー
- ご褒美ごはんにマンネリが出てきてるユーザー。
- 他の人がどんなご褒美ご飯を食べているのか知りたいユーザー。

### 開発した背景
人生を頑張ったご褒美として好きな物を食べる日を定期的に設けていたのですが、
食べるものにローテションが出来てきてしまい、バリーエションがなくなってご褒美…というより惰性で暴飲暴食しているだけなのでは…？と思う様になり、

**もっと上質なご褒美ごはんが食べたい！他の人がどんな物をご褒美に食べているのかを知りたい！**

と思ったことがきっかけです。

まずはTwitterやinstagramなどで探してみたりもしたのですが、下記のの問題に直面しました。
 - 他のSNSは食以外の情報が多すぎて、気がついたら一生TLを眺めてしまう

そんな問題を解決するために、ご褒美ごはんだけを共有するサイトがあればいいのでは？と考えたことが背景となっています。

### 使用画面イメージ
![使用画面イメージimage 001](https://user-images.githubusercontent.com/36786134/173781060-be94a1ba-6493-4358-969c-7cd0b5dd247e.png)


### 使用技術
- フロントエンド
  - HTML/CSS
  - Sass
  - MDBootstrap
  - Vue.js
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
  - AWS(EC2, ALB, ACM, S3, RDS, CodeDeploy, SNS, Chatbot, CloudFormation, Route53, VPC, EIP, IAM, SES)

- ツール
  - Visual Studio Code
  - draw.io

## AWS構成図
![aws_diagram](https://user-images.githubusercontent.com/36786134/167150616-39c4e8e8-a0cc-4783-be78-22c887c00014.png)

## 機能一覧
- **アカウント登録関連**
  - アカウント登録
  - アカウント編集
  - マイページ
  - ログイン・ログアウト
  - かんたんログイン機能（ゲストユーザーログイン）
  - ソーシャルログイン機能（Google）

- **フォロー機能**
  - フォロー・フォロワー機能

- **レシピ投稿機能(CRUD)**
  - ごほうびご飯レシピ登録
  - ごほうびご飯レシピ編集
  - ごほうびご飯レシピ削除
  - ごほうびご飯レシピ詳細
  - ごほうびご飯レシピ一覧（全レシピ投稿一覧、マイレシピ投稿一覧）
  - いいね機能
  - 投稿に対するタグ付け機能
  - 投稿に対するカテゴリ機能

- **コメント機能**
  - 投稿に対するコメント機能
  - コメント一覧

- **タグ機能** (Vue.js/Vue Tags Input)
  - タグ毎の投稿一覧機能

- **検索機能**
  - 投稿に対するあいまい検索機能（タイトルと本文が対象）
  - カテゴリ検索機能
  - 投稿とカテゴリを選択した複合検索

- **ページネーション機能**
  - マイレシピ投稿一覧
  - 全レシピ投稿一覧

- **フラッシュメッセージ表示機能**
  - 投稿、編集、削除、ログイン、ログアウト時にフラッシュメッセージを表示

- **画像アップロード機能 (AWS S3バケット)**
  - 新規投稿、投稿編集、プロフィール変更

- **PHPUnit**

## DB設計
**ER図**
![spoily_er](https://user-images.githubusercontent.com/36786134/167134734-ee947f9e-167a-4f96-8ccd-4a495679e036.png)

### 各テーブルについて
| テーブル名 | 説明 |
|:-:|:-:|
| users  | 一般ユーザー情報  |
| follows | フォロー中/フォロワーのユーザー情報  |
| recipes  | ユーザー投稿の情報  |
| tags  | ユーザー投稿のタグ情報  |
| recipes_tags  | recipeとtagsの中間テーブル  |
| category  | ユーザー投稿のcategory情報  |
| recipes_category  | recipeとcategoryの中間テーブル  |
| likes  | 投稿への、いいねの情報  |
| comments  | ユーザー投稿への、コメントの情報  |