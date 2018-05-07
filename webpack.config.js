module.exports = {
	entry: './app/src/js/app.js',
	output: {
		path: __dirname,
		filename: './js/bundle.js'
	},
	resolve: {
		alias: {
			vue: "vue/dist/vue.js"
		}
	},
	module: {
		// ローダー設定
		rules: [
			{
				test: /\.vue$/,
				loader: 'vue-loader',
			},
			{
				test: /\.css$/,
				loader: 'style-loader!css-loader',
			},
			{
				test: /\.(otf|eot|svg|ttf|woff|woff2)(\?.+)?$/,
				loader: 'url-loader',
			},
			{
				test: /\.(jpg|png|gif)$/,
				loaders: 'url-loader'
			},
		]
	},
};
