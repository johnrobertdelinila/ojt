/*Compile LESS task*/

module.exports = function(grunt, data){

  return {  
    dev: {
       options: {
          paths: ["src/less"]
       },
       files: { "src/html/assets/css/style.css": "src/less/style.less"}
    },
    dist: {
       options: {
          paths: ["src/less"],
          plugins : [ new (require('less-plugin-autoprefix'))({browsers : [
            "Android >= 4",
            "Chrome >= 20",
            "Firefox >= 24",
            "Explorer >= 8",
            "iOS >= 6",
            "Opera >= 12",
            "Safari >= 6"
          ]}) ]
       },
       files: [
        {"dist/assets/css/style.css": "src/less/style.less"}
      ]
    }
  };
};