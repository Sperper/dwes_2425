public function create()
{
    // Array para almacenar errores
    $error = [];

    // Validar token CSRF
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error['csrf'] = 'Token de seguridad no válido.';
    }

    // Validaciones
    if (empty($_POST['nombre']) || strlen($_POST['nombre']) < 2) {
        $error['nombre'] = 'El nombre es obligatorio y debe tener al menos 2 caracteres.';
    }

    if (empty($_POST['apellidos']) || strlen($_POST['apellidos']) < 2) {
        $error['apellidos'] = 'Los apellidos son obligatorios y deben tener al menos 2 caracteres.';
    }

    if (empty($_POST['fechaNac']) || !preg_match('/^\\d{4}-\\d{2}-\\d{2}$/', $_POST['fechaNac'])) {
        $error['fechaNac'] = 'La fecha de nacimiento es obligatoria y debe tener el formato AAAA-MM-DD.';
    }

    if (empty($_POST['dni']) || !preg_match('/^[0-9]{8}[A-Za-z]$/', $_POST['dni'])) {
        $error['dni'] = 'El DNI es obligatorio y debe tener el formato 12345678A.';
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'El email es obligatorio y debe tener un formato válido.';
    }

    if (empty($_POST['telefono']) || !preg_match('/^\\+?[0-9\\s]{9,15}$/', $_POST['telefono'])) {
        $error['telefono'] = 'El teléfono es obligatorio y debe tener un formato válido.';
    }

    if (empty($_POST['nacionalidad']) || strlen($_POST['nacionalidad']) < 2) {
        $error['nacionalidad'] = 'La nacionalidad es obligatoria y debe tener al menos 2 caracteres.';
    }

    if (empty($_POST['id_curso']) || !is_numeric($_POST['id_curso'])) {
        $error['id_curso'] = 'Debe seleccionar un curso válido.';
    }

    // Si hay errores, redirigir al formulario con los errores
    if (!empty($error)) {
        $_SESSION['error'] = $error;
        header('Location: ' . URL . 'alumno/form');
        exit;
    }

    // Guardar los datos en la base de datos
    try {
        $stmt = $this->db->prepare('INSERT INTO alumnos (nombre, apellidos, fecha_nacimiento, dni, email, telefono, nacionalidad, id_curso) VALUES (:nombre, :apellidos, :fechaNac, :dni, :email, :telefono, :nacionalidad, :id_curso)');
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':apellidos', $_POST['apellidos']);
        $stmt->bindParam(':fechaNac', $_POST['fechaNac']);
        $stmt->bindParam(':dni', $_POST['dni']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':nacionalidad', $_POST['nacionalidad']);
        $stmt->bindParam(':id_curso', $_POST['id_curso'], PDO::PARAM_INT);
        $stmt->execute();

        // Redirigir al listado de alumnos
        $_SESSION['success'] = 'Alumno registrado correctamente.';
        header('Location: ' . URL . 'alumno');
        exit;
    } catch (PDOException $e) {
        $_SESSION['error']['db'] = 'Error al guardar en la base de datos: ' . $e->getMessage();
        header('Location: ' . URL . 'alumno/form');
        exit;
    }
}
