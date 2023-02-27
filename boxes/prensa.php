<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()">
    <img src="images/close.png" alt="close" />
  </button>
  <h2 class="uppercase">CONTACTO DE PRENSA</h2>
  <h3>PR, Material de prensa, entrevistas, comentarios...</h3>
  <div class="caution">
    <img src="" alt="" />
    <p>
      <strong
        >Este formulario es solo para asuntos relacionados con la prensa. No es
        para consultas de servicios de producción o de atención al
        cliente.</strong
      >
    </p>
    <p>
      Si necesitas ayuda para asuntos relacionados con la prensa, cumplimenta el
      siguiente formulario.
    </p>
  </div>
  <form action="/set/senForm.php" method="POST" id="prensa">
    <hr />

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
        <label for="proyecto"> Teléfono de contacto* </label>
        <input type="text" id="proyecto" name="proyecto" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="country"> País* </label>
        <input type="text" id="country" name="country" />
      </span>
      <span>
        <label for="type">Tipo de solicitud*</label>
        <div class="c-select custom-select">
          <select name="type" id="type">
            <option value="0">Selecciona una opción</option>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
    </div>

    <div class="flex">
      <span>
        <label for="oficina"> Oficina de medios* </label>
        <input type="text" id="oficina" name="oficina" />
      </span>
      <span>
        <label for="enlace"> Enlace al sitio de medios</label>
        <input type="text" id="enlace" name="enlace" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="medios">Medios asociados*</label>
        <div class="c-select custom-select">
          <select name="medios" id="medios">
            <option value="0">Selecciona una opción</option>
          </select>
          <div class="c-arrow"></div>
        </div>
      </span>
      <span>
        <label for="msg"> Mensaje* </label>
        <textarea name="msg" id="msg" cols="30" rows="10"></textarea>
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
    <input type="hidden" name="type_for" id="type_for" value="8">
    <button class="btn orange-bg" type="submit">Enviar información</button>
  </form>
</div>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>validateForms(
  "prensa",
  {
    name: { required: true },
    lastname: { required: true },
    cc: { required: true },
    proyecto: { required: true },
    country: { required: true },
    type: { required: true },
    oficina: { required: true },
    enlace: { required: true },
    medios: { required: true },
    msg: { required: true },
  },
  {
    name: { required: "Campo obligatorio*" },
    lastname: { required: "Campo obligatorio*" },
    cc: { required: "Campo obligatorio*" },
    proyecto: { required: "Campo obligatorio*" },
    country: { required: "Campo obligatorio*" },
    type: { required: "Campo obligatorio*" },
    oficina: { required: "Campo obligatorio*" },
    enlace: { required: "Campo obligatorio*" },
    medios: { required: "Campo obligatorio*" },
    msg: { required: "Campo obligatorio*" },
  }
);
</script>

