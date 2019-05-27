<?php

$proyecto = '/MVC/';
//$proyecto = '/';
$rutaPrincipal = $proyecto . 'index.php';
define('CARPETA_PRINCIPAL', __DIR__);
define('RUTA_PRINCIPAL', $rutaPrincipal);
define('CSS',$proyecto .'vista/assets/css/'); //ruta CSS
define('JS',$proyecto .'vista/assets/js/'); //ruta JS



//usuario controlador
define('USUARIO_AUTENTICAR', array('url' => $rutaPrincipal . '/usuario/autenticarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'autenticarUsuario'));
define('USUARIO_VISTA_REGISTRAR', array('url' => $rutaPrincipal . '/usuario/vistaRegistrarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'vistaRegistrarUsuario'));
define('USUARIO_VISTA_ACTUALIZAR', array('url' => $rutaPrincipal . '/usuario/vistaActualizarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'vistaActualizarUsuario'));
define('USUARIO_REGISTRAR', array('url' => $rutaPrincipal . '/usuario/registrarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'registrarUsuario'));
define('USUARIO_ELIMINAR', array('url' => $rutaPrincipal . '/usuario/eliminarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'eliminarUsuario'));
define('USUARIO_CONSULTAR', array('url' => $rutaPrincipal . '/usuario/consultarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'consultarUsuario'));
define('USUARIO_LISTAR', array('url' => $rutaPrincipal . '/usuario/listarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'listarUsuario'));
define('USUARIO_EDITAR', array('url' => $rutaPrincipal . '/usuario/actualizarUsuario', 'controlador' => 'UsuarioControlador', 'metodo' => 'editarUsuario'));
define('CERRAR_SESION',array('url' => $rutaPrincipal . '/usuario/sesion/cerrar', 'controlador' => 'UsuarioControlador', 'metodo' => 'cerrarSesion'));

//libro controlador

define('LIBRO_VISTA_REGISTRAR', array('url' => $rutaPrincipal . '/libro/vistaRegistrarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'vistaRegistrarLibro'));
define('LIBRO_VISTA_ACTUALIZAR', array('url' => $rutaPrincipal . '/libro/vistaActualizarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'vistaActualizarLibro'));
define('LIBRO_REGISTRAR', array('url' => $rutaPrincipal . '/libro/registrarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'registrarLibro'));
define('LIBRO_ELIMINAR', array('url' => $rutaPrincipal . '/libro/eliminarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'eliminarLibro'));
define('LIBRO_CONSULTAR', array('url' => $rutaPrincipal . '/libro/consultarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'consultarLibro'));
define('LIBRO_LISTAR', array('url' => $rutaPrincipal . '/libro/listarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'listarLibro'));
define('LIBRO_EDITAR', array('url' => $rutaPrincipal . '/libro/actualizarLibro', 'controlador' => 'LibroControlador', 'metodo' => 'editarLibro'));

define('LIBRO_LISTAR_GENERO', array('url' => $rutaPrincipal . '/libro/listarLibroGenero', 'controlador' => 'LibroControlador', 'metodo' => 'vistaListarGenero'));


//evidencia controlador
define('EVIDENCIA_LISTAR', array('url' => $rutaPrincipal . '/evidencia/listarArchivo', 'controlador' => 'EvidenciaControlador', 'metodo' => 'listarArchivo'));
define('EVIDENCIA_VISTA_REGISTRAR', array('url' => $rutaPrincipal . '/evidencia/vistaRegistrarLibro', 'controlador' => 'EvidenciaControlador', 'metodo' => 'vistaRegistrarArchivo'));
define('EVIDENCIA_REGISTRAR', array('url' => $rutaPrincipal . '/evidencia/registrarArchivo', 'controlador' => 'EvidenciaControlador', 'metodo' => 'registrarArchivo'));

