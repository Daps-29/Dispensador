var mysql = require('mysql');

var con = mysql.createConnection({
  host: "dispo.ga",
  user: "admin_disp",
  password: "david123",
  database: "admin_dispo"
});
con.connect(function(err){
  if (err) throw err;
  var query = "SELECT * FROM usuario";
  con.query(query, function(err,result,fields){
    if(err) throw err;
    if(result.length>0){
      console.log(result);
    }
  });
});
