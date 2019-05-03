const WebpackAssetsManifest = require("webpack-assets-manifest");

module.exports = {
  publicPath: "dist",
  outputDir: "../public/dist",
  runtimeCompiler: true,
  configureWebpack: {
    plugins: [new WebpackAssetsManifest()]
  }
};
