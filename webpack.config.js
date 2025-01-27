const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  entry: path.resolve(__dirname, 'public/src/js/index.js'),
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, 'public/assets/js'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',  // Transpilação para compatibilidade com navegadores
        },
      },
      {
        test: /\.css$/, // Para arquivos CSS
        use: [
          MiniCssExtractPlugin.loader, // Extrai o CSS para um arquivo separado
          'css-loader', // Interpreta o conteúdo do CSS
        ],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '../css/styles.css', // Caminho para o arquivo CSS gerado
    }),
  ],
};
