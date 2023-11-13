<?php
require("coneccion/connection.php");
session_start();

// Si se cerro la sesión por otro lado
$definido = isset($_SESSION['usuario']);
// No está definido la variable
if ($definido == false) {

  header("Location:error1.php");
  exit();
}

if (isset($_GET['producto'])) {

  $id_producto = $_GET['id_producto'];
  $producto = $_GET['producto'];
  $descripcion = $_GET['descripcion'];
} else {

  $id_producto = "";
  $producto = "";
  $descripcion = "";
}

?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <title> Artículo - Ingresar </title>

  <link rel="stylesheet" href="demo/libs/bundled.css">
  <script src="demo/libs/bundled.js"></script>
  <script src="js/jquery-latest.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery-confirm.css" />
  <script type="text/javascript" src="js/jquery-confirm.js"></script>

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="fonts/style.css">

  <link rel="shortcut icon" href="imagen/avatar.png" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <style type="text/css">
    .usuario3 {

      color: black;
      font-size: 16px;

    }

    .th_color {

      background: #66cc00;

    }

    .navbar {

      background: #66cc00;

    }

    .body1 {

      background: #66cc00;

    }

    .menu2 {

      font-size: 24px;
      color: black;

    }

    .encab {

      font-size: 18px;

    }

    @media screen and (max-width:400px) {

      .menu2 {

        font-size: 19px;
        color: black;

      }

    }
  </style>

  <script>
    $(document).on('ready', function() {

      $('#btn-enviar').click(function() {

        // confirmation
        $.confirm({
          title: 'Mensaje',
          content: '¿Confirma en guardar?',
          animation: 'scale',
          closeAnimation: 'zoom',
          buttons: {
            confirm: {
              text: 'Si',
              btnClass: 'btn-orange',

              action: function() {

                var url = "productos_crear_validar.php";

                $.ajax({
                  type: "POST",
                  url: url,
                  data: $("#formulario_producto").serialize(),
                  beforeSend: function() {
                    $("#resp").html("<img src='imagen/loader-small.gif'/><font color='green'>&nbsp&nbspProcesando, por favor espere...</font>");
                  },
                  success: function(data) {
                    $('#resp').html(data);
                  }
                });

              } // action: function(){

            }, // confirm: {

            cancelar: function() {

            } // cancelar: function()

          } // buttons

        }); // $.confirm

      });

    });
  </script>

</head>

<body class="body1">

  <nav class="navbar navbar-default">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">

        <p class="navbar-brand"><span class="menu2">Dir. de Arquitectura</span></p>
        <p class="navbar-brand"><span class="menu2"><a href="panel.php">Menu</a></span></p>
        <p class="navbar-brand"><span class="menu2"><a href="productos.php">Volver</a></span></p>

      </div>

      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <div class="container">

    <p class="usuario3">

      <span class="encab">
        <span class="text-danger">
          Fecha: <?php echo $_SESSION['fecha']; ?>
          <br />
          Usuario: <?php echo $_SESSION['usuario']; ?>
        </span>
      </span>

    </p>

    <h4>Ingresar Producto</h4>

    <form id="formulario_producto" class="form-horizontal" method="post" action="return false" onsubmit="return false">

      <div class="form-group">
        <label for="id_producto" class="control-label col-md-2">Cód. Artículo:</label>
        <div class="col-md-7">
          <table>
            <tr>
              <td>
                <input id="id_producto" class="form-control" type="text" name="id_producto" value="<?php echo $id_producto ?>" size="20" maxlength="15" />
              </td>
              <td>
                &nbsp&nbsp
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="form-group">
        <label for="producto" class="control-label col-md-2">Producto:</label>
        <div class="col-md-9">
          <input id="producto" class="form-control" type="text" name="producto" value="<?php echo $producto ?>" size="100" maxlength="100" autofocus />
        </div>
      </div>

      <div class="form-group">
        <label for="descripcion" class="control-label col-md-2">Descripción:</label>
        <div class="col-md-9">
          <input id="descripcion" class="form-control" type="text" name="descripcion" value="<?php echo $descripcion ?>" size="250" maxlength="250" />
        </div>
      </div>



      <div class="form-group">
        <div class="col-md-1 col-md-offset-2">
          <button id="btn-enviar" class="btn btn-success" /><b>Guardar</b></button>
        </div>
      </div>

      <div>&nbsp&nbsp</div>
      <div id="resp"></div>

    </form>

  </div>

  <div id="resultado"></div>
  <br />

  <?php

  if (isset($_SESSION['producto_mensaje']) && $_SESSION['producto_mensaje'] == "si") {

    $_SESSION['producto_mensaje'] = 'no';
    $contenido_mensaje = $_SESSION['contenido_mensaje_prod'];
    echo "<script>
        
        $.alert({

              title: 'Mensaje',
              content: '<span style=color:red>$contenido_mensaje.</span>',
              animation: 'scale',
              closeAnimation: 'scale',
              buttons: {
                okay: {
                    text: 'Cerrar',
                    btnClass: 'btn-warning'
                }
              }
          }); 

      </script>";
  }

  ?>

  <div class="panel-footer">
    <div class="container">
      <?php
      // mini Sistemas cjcv
      require("mini.php");
      ?>
    </div>
  </div>
</body>

</html>