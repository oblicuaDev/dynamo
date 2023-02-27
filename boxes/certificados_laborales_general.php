<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()">
    <img src="images/close.png" alt="close" />
  </button>
  <h2 class="uppercase">CERTIFICADO LABORAL GENERAL</h2>
  <h3>Solicítalo aquí.</h3>
  <div class="caution">
    <img src="" alt="" />
    <p>
      <strong
        >Este formulario solo es para asuntos relacionados con certificados
        laborales por proyecto. No es para hacer consultas de comunicación o
        sobre producciones.</strong
      >
    </p>
    <p>
      Si tienes dudas
      <a href=""> contáctanos </a>
      o visita nuestra sección de
      <a href=""> preguntas frecuentes. </a>
    </p>
  </div>
  <form action="/set/senForm.php" method="POST" id="certificados_laborales_general">
    <hr />
    <p>
      La respuesta a esta solicitud puede tomar hasta tres (3) días hábiles.
    </p>
    <div class="flex">
      <span>
        <label for="name"> Nombres* </label>
        <input type="text" id="name" name="name" />
      </span>
      <span>
        <label for="lastname"> Apellidos* </label>
        <input type="text" id="lastname" name="lastname" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="cc"> Cédula / Documento* </label>
        <input type="text" id="cc" name="cc" />
      </span>
      <span>
        <label for="cargo"> Cargo* </label>
        <input type="text" id="cargo" name="cargo" />
      </span>
    </div>

    <div class="flex">
      <span>
        <label for="initial"> Fecha de ingreso* </label>
        <input type="date" id="initial" name="initial" />
      </span>
      <span>
        <label for="final"> Fecha de retiro* </label>
        <input type="date" id="final" name="final" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="salario"> Salario* </label>
        <input type="text" id="salario" name="salario" />
      </span>
    </div>

    <hr />
    <div class="politics_checkbox">
      <input type="checkbox" name="politics" id="politics" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics"
        >Acepto los
        <a href="" target="_blank">términos y condiciones.</a></label
      >
    </div>
    <input type="hidden" name="type_for" id="type_for" value="2">
    <button class="btn orange-bg" type="submit">Enviar información</button>
  </form>
</div>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>validateForms(
  "certificados_laborales_general",
  {
    name: { required: true },
    lastname: { required: true },
    cc: { required: true },
    cargo: { required: true },
    initial: { required: true },
    final: { required: true },
    salario: { required: true },
  },
  {
    name: { required: "Campo obligatorio*" },
    lastname: { required: "Campo obligatorio*" },
    cc: { required: "Campo obligatorio*" },
    cargo: { required: "Campo obligatorio*" },
    initial: { required: "Campo obligatorio*" },
    final: { required: "Campo obligatorio*" },
    salario: { required: "Campo obligatorio*" },
  }
);</script>
