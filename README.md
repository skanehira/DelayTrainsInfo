# SPAサンプル
vue周りの関連コンポーネントを使用したSingle Page Applicationのサンプル

# 構成
## フレームワーク
- Slim3  
サーバーサイド
PHPのマイクロフレームワーク

- vue.js  
MVVM(Model View ViewModel)フレームワーク  
双方向データバインディングなのでDOMを直接いじることはしない

## コンポーネント  
- vue-router  
vue.jsのルーティングコンポーネント
名前通りrouterの役割をもつ

- element-ui  
vue.jsのUIコンポーネント
bootstrapと同じ

## ビルド関連
- webpack, webpack-cli  
html,js,cssをビルドする  
拡張子ごとにローダーを指定するする必要がある  

- ローダー(https://qiita.com/shuntksh/items/bb5cbea40a343e2e791a)
	- css-loader
	- style-loader  
	- url-loader
	- vue-loader

- コンパイラー
	- vue-tempate-compiler

