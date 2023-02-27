<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()">
    <img src="images/close.png" alt="close" />
  </button>
  <h2 class="uppercase">CERTIFICADO TRIBUTARIO</h2>
  <h3>Solicítalo aquí.</h3>
  <div class="caution">
    <img src="" alt="" />
    <p>
      <strong
        >Este formulario solo es para asuntos relacionados con certificados
        tributarios. No es para hacer consultas de comunicación o sobre
        producciones.
      </strong>
    </p>
    <p>
      Si tienes dudas
      <a href=""> contáctanos </a>
      o visita nuestra sección de
      <a href=""> preguntas frecuentes. </a>
    </p>
  </div>
  <form action="/set/senForm.php" method="POST" id="certificados_tributarios">
    <hr />
    <p>
      La respuesta a esta solicitud puede tomar hasta tres (3) días hábiles.
    </p>
    <div class="flex">
      <span>
        <label for="name"> Nombres / Razón social* </label>
        <input type="text" id="name" name="name" />
      </span>
      <span>
        <label for="lastname"> Apellidos* </label>
        <input type="text" id="lastname" name="lastname" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="project"> Proyecto asociado** </label>
        <input type="text" id="project" name="project" />
      </span>
      <span>
        <label for="cc">Cédula / NIT*</label>
        <input type="text" id="cc" name="cc" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="iva">IVA*</label>
        <input type="text" id="iva" name="iva" />
      </span>
      <span>
        <label for="agente">Actúa como agente*</label>
        <div class="c-select custom-select">
          <select name="agente" id="agente">
            <option value="0">Selecciona una opción</option>
            <option value="Si">Si</option>
            <option value="No">No</option>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="certificado">Tipo de certificado*</label>
        <div class="c-select custom-select">
          <select name="certificado" id="certificado">
            <option value="0">Selecciona una opción</option>
            <option value="Tipo 1">Tipo 1</option>
            <option value="Tipo 2">Tipo 2</option>
            <option value="Tipo 3">Tipo 3</option>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
      <span>
        <label for="periodo">Periodo del certificado*</label>
        <input type="text" id="periodo" name="periodo" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="email"> Correo electrónico* </label>
        <input type="text" id="email" name="email" />
      </span>
      <span>
        <label for="phone">Teléfono de contacto*</label>
        <input type="text" name="phone" id="phone" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="address"> Dirección*</label>
        <input type="text" id="address" name="address" />
      </span>
      <span>
        <label for="city">Ciudad*</label>
        <input type="text" name="city" id="city" />
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
  
    <input type="hidden" name="type_for" id="type_for" value="4">
    <button class="btn orange-bg" type="submit">Enviar información</button>
  </form>
</div>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>validateForms(
  "certificados_tributarios",
  {
    name: { required: true },
    lastname: { required: true },
    project: { required: true },
    cc: { required: true },
    iva: { required: true },
    agente: { required: true },
    certificado: { required: true },
    periodo: { required: true },
    email: { required: true },
    phone: { required: true },
    address: { required: true },
    city: { required: true },
  },
  {
    name: { required: "Campo obligatorio*" },
    lastname: { required: "Campo obligatorio*" },
    project: { required: "Campo obligatorio*" },
    cc: { required: "Campo obligatorio*" },
    iva: { required: "Campo obligatorio*" },
    agente: { required: "Campo obligatorio*" },
    certificado: { required: "Campo obligatorio*" },
    periodo: { required: "Campo obligatorio*" },
    email: { required: "Campo obligatorio*" },
    phone: { required: "Campo obligatorio*" },
    address: { required: "Campo obligatorio*" },
    city: { required: "Campo obligatorio*" },
  }
);</script>

