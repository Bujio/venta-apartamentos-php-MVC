<?php


namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Model\Propiedad;


class VendedoresController
{

  public static function index(Router $router)
  {
    $vendedores = Vendedor::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    $router->render('vendedores/index', [
      'vendedores' => $vendedores,
      'resultado' => $resultado
    ]);
  }

  public static function crear(Router $router)
  {
    $vendedor = new Vendedor();
    //ARREGLO CON MSJ DE ERRORES
    $errores = Vendedor::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

      //CREA NUEVA INSTANCIA
      $vendedor = new Vendedor($_POST['vendedor']);

      //VALIDAR
      $errores = $vendedor->validar();

      if (empty($errores)) {    // SI NO HAY ERRORES LO VA A GUARDAR EN LA BD

        //GUARDA EN LA BASE DE DATOS
        $vendedor->guardar();
      }
    }


    $router->render("vendedores/crear", [
      'vendedor' => $vendedor,
      'errores' => $errores
    ]);
  }


  public static function actualizar(Router $router)
  {

    $id = validarORedireccionar('/vendedores');

    // Obtener los datos del vendedor
    $vendedor = Vendedor::find($id);
    // Consultar para obtener los vendedores
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Vendedor::getErrores();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Asignar los atributos
      $args = $_POST['vendedor'];


      $vendedor->sincronizar($args);

      // Validación
      $errores = $vendedor->validar();



      if (empty($errores)) {
        // Guarda en la base de datos
        $resultado = $vendedor->guardar();

        if ($resultado) {
          header('location: /vendedores');
        }
      }
    }

    $router->render('vendedores/actualizar', [
      'vendedor' => $vendedor,
      'errores' => $errores
    ]);
  }


  public static function eliminar()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);

      if ($id) {
        $tipo = $_POST['tipo'];
        if (validarTipoContenido($tipo)) {
          $vendedor = Vendedor::find($id);
          $vendedor->eliminar();
        }
      }
    }
  }
}
