<?php


namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
  public static function index(Router $router)
  {
    $vendedores = Vendedor::all();
    $propiedades = Propiedad::all();
    $resultado = $_GET['resultado'] ?? null;
    $router->render("propiedades/admin", [
      'vendedores' => $vendedores,
      'propiedades' => $propiedades,
      'resultado' => $resultado
    ]);
  }


  public static function crear(Router $router)
  {
    $propiedad = new Propiedad;
    $vendedores = Vendedor::all();
    //ARREGLO CON MSJ DE ERRORES
    $errores = Propiedad::getErrores();

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

      //CREA NUEVA INSTANCIA
      $propiedad = new Propiedad($_POST['propiedad']);


      //++SUBIDA DE ARCHIVOS++//
      //GENERAR UN NOMBRE UNICO
      $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

      //SETEAR LA IMAGEN
      //REALIZA UN RESIZE A LA IMAGEN CON INTERVENTION
      if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
      }

      //VALIDAR
      $errores = $propiedad->validar();



      if (empty($errores)) {    // SI NO HAY ERRORES LO VA A GUARDAR EN LA BD


        //CREAR UNA CARPETA
        if (!is_dir(CARPETA_IMAGENES)) {
          mkdir(CARPETA_IMAGENES);
        }

        //GUARDA LA IMAGEN EN EL SERVIDOR
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //GUARDA EN LA BASE DE DATOS
        $propiedad->guardar();
      }
    }


    $router->render("propiedades/crear", [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
      'errores' => $errores
    ]);
  }


  public static function actualizar(Router $router)
  {

    $id = validarORedireccionar('/propiedades');

    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consultar para obtener los vendedores
    $vendedores = Vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      // Asignar los atributos
      $args = $_POST['propiedad'];

      $propiedad->sincronizar($args);

      // Validación
      $errores = $propiedad->validar();

      // Subida de archivos
      // Generar un nombre único
      $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

      if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
      }



      if (empty($errores)) {
        // Almacenar la imagen
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
          $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

        // Guarda en la base de datos
        $resultado = $propiedad->guardar();

        if ($resultado) {
          header('location: /propiedades');
        }
      }
    }

    $router->render('propiedades/actualizar', [
      'propiedad' => $propiedad,
      'vendedores' => $vendedores,
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
          $propiedad = Propiedad::find($id);
          $propiedad->eliminar();
        }
      }
    }
  }
}
