const { defineConfig } = require("@vue/cli-service");

module.exports = defineConfig({
  transpileDependencies: ["quasar"],

  pluginOptions: {
    quasar: {
      importStrategy: "kebab",
      rtlSupport: false,
    },
  },

  configureWebpack: {
    resolve: {
      fallback: {
        crypto: require.resolve("crypto-browserify"),
        util: require.resolve("util/"),
        stream: require.resolve("stream-browserify"),
      },
    },
  },

  devServer: {
    proxy: {
      "/api": {
        target: "http://cibackend.test",
        changeOrigin: true,
        pathRewrite: {
          "^/api": "",
        },
        headers: {
          "Access-Control-Allow-Origin": "*",
          "Access-Control-Allow-Methods":
            "GET, POST, PUT, DELETE, PATCH, OPTIONS",
          "Access-Control-Allow-Headers":
            "X-Requested-With, content-type, Authorization",
        },
      },
    },
  },
});
