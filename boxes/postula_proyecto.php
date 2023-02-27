<div class="boxes form">
  <button id="closeBox" onclick="Fancybox.close()"><img src="images/close.png" alt="close" /></button>
  <h2 class="uppercase">POSTULA
    UN PROYECTO</h2>
  <h3>¿Tienes una idea? Compártela con nosotros.

  </h3>
  <div class="caution">
    <img src="" alt="" />
    <p>
      <strong
        >Este formulario solo es para asuntos relacionados recepcion de ideas.
        No es para aplicar a trabajo, consultas de servicios de producción o
        atención al cliente.
      </strong>
    </p>
    <p>
      Si estás buscando trabajo, haz clic aquí. Si quieres saber más de nuestras
      producciones, <a href="">contáctanos</a> o visita nuestra sección de
      <a href="">preguntas frecuentes.</a>
    </p>
  </div>
  <form action="/set/senForm.php" method="POST" id="postula_proyecto">
    <hr />
    <div class="double">
      <p>
        Si quieres que Dynamo considere tu proyecto o idea para una película,
        serie o algún formato audiovisual, diligencia el siguiente formulario y
        adjunta un <strong>one-pager</strong> con el título, logline, género,
        formato y un texto breve que nos cuente por qué es importante su visión
        y de qué se trata el proyecto.
      </p>
      <p>
        Tu One-pager puede estar en español o en inglés.
        <strong>No aceptamos ni examinamos guiones o biblias.</strong>
      </p>
    </div>
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
        <label for="email"> Correo electrónico* </label>
        <input type="text" id="email" name="email" />
      </span>
      <span>
        <label for="phone"> Celular* </label>
        <input type="text" id="phone" name="phone" />
      </span>
    </div>
    <div class="flex">
      <span>
        <label for="perfil"> IMDB (URL al perfil) </label>
        <input type="text" id="perfil" name="perfil" />
      </span>
      <span>
        <label for="doc"> Créditos* </label>
        <input type="file" id="file" name="file" />
        <div class="recomm">
          <small class="OpenSans"
            >Un único documento en formato PDF con los créditos de tu proyecto ¿de quién o quiénes es la idea?</small
          >
          <label for="file"> ADJUNTAR </label>
        </div>
      </span>
    <div class="flex">
      <span>
        <label for="file2" class="orange"> One-pager* </label>
        <input type="file" id="file2" name="file2" />
        <div class="recomm">
          <small class="OpenSans"
            >Un único documento en formato PDF con los créditos de tu proyecto ¿de quién o quiénes es la idea?</small
          >
          <label for="doc"> ADJUNTAR </label>
        </div>
      </span>
    </div>
    <hr />
    <div class="politics_checkbox">
      <input type="checkbox" name="politics" id="politics" checked />
      <span class="politics_checkbox_mark"></span>
      <label for="politics"
        >He leído y acepto los <a href="">términos y condiciones de uso</a> de esta página web, así como la <a href="">Política de recepción de información y presentación de ideas.</a> </label
      >
    </div>
  
    <input type="hidden" name="type_for" id="type_for" value="7">
    <button class="btn orange-bg" type="submit">Enviar información</button>
  </form>
</div>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdPOOcjAAAAAJAkv-6U5WpgH-3EL1jzC3cOYdOt"></script>
<script>validateForms(
  "postula_proyecto",
  {
    name: { required: true },
    lastname: { required: true },
    email: { required: true },
    phone: { required: true },
    perfil: { required: true },
  },
  {
    name: { required: "Campo obligatorio*" },
    lastname: { required: "Campo obligatorio*" },
    email: { required: "Campo obligatorio*" },
    phone: { required: "Campo obligatorio*" },
    perfil: { required: "Campo obligatorio*" },
  }
);
</script>

