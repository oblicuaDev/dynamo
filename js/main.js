let globalURL = "https://dynamo.mottif.tv";

const getFestivalesPlataformas = async (element, type, q=0) => {
  let logos = [];
  
  if (element[type] != "" && element[type] != undefined) {
    let festivales = element[type].split(", ");
    let limit = festivales.length;
    if(q>0)
    {
      limit = 1;
    }
    console.log(limit);
    for (let f = 0; f < limit; f++) {
      const festival = festivales[f];
      let logo = await getTaxs(festival);
      logos.push(`<img src="${globalURL}${logo}" alt="${logo}" />`);
    }
  }
  return logos.join("");
};

document.addEventListener("DOMContentLoaded", () => {
  // Check if the URL contains the query string "?pruebas=1"
  if (location.search.includes("pruebas=1")) {
    // Get all the <a> elements on the page
    const allLinks = document.querySelectorAll(
      ".menu a, nav a, header a, footer a"
    );

    // Loop through all the <a> elements and prevent the default click behavior
    allLinks.forEach(function (link) {
      link.addEventListener("click", function (e) {
        e.preventDefault();
      });
    });
  }
  if (document.querySelector(".serie")) {
    //console.log("Okokoko");
       // document.querySelector("main").style.height = document.querySelector("main").offsetHeight- 220 +"px";
        
    
  }
  if (document.querySelector(".splide__home-1")) {
    new Splide(".splide__home-1", {
      perPage: 5,
      focus: "center",
      pagination: false,
      type: "loop",
      gap: 16,
      breakpoints: {
        768: {
          trimSpace: false,
          perPage: 2,
          arrows: false,
          perMove: 1,
        },
      },
    }).mount();
  }
  if (document.querySelector(".home .slider-4")) {
    let list = document.querySelector(".slider-4 .splide__list");
    list.innerHTML = "";
    async function getNews() {
      await fetch("get/news.php")
        .then((res) => res.json())
        .then((data) => {
          data.forEach((element) => {
            let template = `
            <li class="slider-4-item splide__slide">
              <div class="text">
               ${element.field_descripcion_corta}
                <small>${element.field_fecha}</small>
                <a href="${element.field_link_noticia}" target="_blank" class="btn nobg">VER MÁS</a>
              </div>
              <div class="image">
                <img src="${globalURL}${element.field_image}" alt="${element.title}" />
              </div>
            </li>`;
            list.innerHTML += template;
          });
        })
        .then(() => new Splide(".slider-4", { pagination: false }).mount());
    }
    getNews();
  }
  if (document.querySelector(".banner-3.container")) {
    let list = document.querySelector(".banner-3.container");
    list.innerHTML = "";
    async function getMovieHome() {
      await fetch(`get/movies.php?id=${infoGnrl.field_pelicula_destacada}`)
        .then((res) => res.json())
        .then((element) => {
          let template = `
            <div class="logo-container">
              <img src="${globalURL}${element.field_logo}" alt="${
            element.title
          }" class="logo" />
              <a href="peliculas/${get_alias(element.title)}-${
            element.nid
          }" class="btn nobg">CONOCER</a>
            </div>
            <img src="${globalURL}${element.field_banner}" alt="banner3" />`;
          list.innerHTML = template;
        })
        .then(() => new Splide(".slider-4").mount());
    }
    getMovieHome();
  }

  if (document.querySelector("#menu")) {
    document.querySelector("#menu").addEventListener("click", () => {
      document.querySelector(".menu").classList.toggle("active");
      if (
        document.querySelector("#menu img").src.split("/")[
          document.querySelector("#menu img").src.split("/").length - 1
        ] == "menu.png" &&
        window.innerWidth > 768
      ) {
        document.querySelector("#menu img").src = "images/cerrar.png";
      } else {
        document.querySelector("#menu img").src = "images/menu.png";
      }
    });
  }
  if (document.querySelector("#closemenu")) {
    document.querySelector("#closemenu").addEventListener("click", () => {
      document.querySelector(".menu").classList.toggle("active");
    });
  }
});

if (document.querySelector(".banner-home")) {
  const getBannersHome = async () => {
    // Build the URLs for the API calls
    const urls = [
      "https://dynamo.mottif.tv/home/bo39bipxontb/public_html/dynamo.mottif.tv/drpl/api/v1/banners-home",
    ];

    // Make the API calls and get the responses
    const arrayOfResponses = await Promise.all(
      urls.map(async (url) => {
        const response = await fetch(url);
        return response.json();
      })
    );

    // Map the responses to the desired data structure
    const dataMap = await Promise.all(
      arrayOfResponses.map(async (res) => {
        const mappedData = res.map((banner) => ({
          id: banner.nid,
          image: `${globalURL}${banner.field_image}`,
          image1: banner.field_imagen_1
            ? `${globalURL}${banner.field_imagen_1}`
            : "",
          image2: banner.field_imagen_2
            ? `${globalURL}${banner.field_imagen_2}`
            : "",
          name: banner.title,
          content: banner.body,
          link: banner.field_link,
        }));
        return mappedData;
      })
    );

    // Flatten the nested arrays
    const flattenedData = dataMap.flat();

    return flattenedData;
  };

  // Use the getBannersHome function

  getBannersHome()
    .then((arraybanners) => {
      let index = 0;
      let timeSlider = 4000;
      let dots = document.getElementById("dots");
      arraybanners.map((banner, i) => {
        dots.innerHTML += `<div class="dot"><div class="dot-fill"></div></div>`;
      });
      let dotElements = document.querySelectorAll(".dot");
      function animationStart() {
        document.querySelector(
          ".banner-home img"
        ).src = `${arraybanners[index].image}`;
        document.querySelector(
          ".banner-home .btn.more"
        ).href = `${arraybanners[index].link}`;
        document.querySelector(
          ".info .top h2"
        ).innerHTML = `${arraybanners[index].name}`;
        document.querySelector(
          ".director"
        ).innerHTML = `${arraybanners[index].content}`;

        document.querySelector(".banner-home .platforms").innerHTML =
          arraybanners[index].image1 != ""
            ? `<img src="${arraybanners[index].image1}" alt="${arraybanners[index].name}"/>`
            : "";

        document.querySelector(".banner-home .festivales").innerHTML =
          arraybanners[index].image2 != ""
            ? `<img src="${arraybanners[index].image2}" alt="${arraybanners[index].name}" /`
            : "";

        dotElements[index].classList.add("active");
        if (index == arraybanners.length - 1) {
          index = 0;
          setTimeout(() => {
            dotElements.forEach((dot) => dot.classList.remove("active"));
          }, timeSlider - 300);
        } else {
          index++;
        }
        width = 0;
      }
      animationStart();
      intervalAnimationStart = setInterval(() => {
        animationStart();
      }, timeSlider);
    })
    .then(() => document.getElementById("preloader").classList.add("hidden"));
} else {
  document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("preloader").classList.add("hidden");
  });
}

function get_alias(str) {
  str = str.replace(/¡/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/'/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/!/g, "", str); //Signo de exclamación abierta.&iexcl;
  str = str.replace(/¢/g, "-", str); //Signo de centavo.&cent;
  str = str.replace(/£/g, "-", str); //Signo de libra esterlina.&pound;
  str = str.replace(/¤/g, "-", str); //Signo monetario.&curren;
  str = str.replace(/¥/g, "-", str); //Signo del yen.&yen;
  str = str.replace(/¦/g, "-", str); //Barra vertical partida.&brvbar;
  str = str.replace(/§/g, "-", str); //Signo de sección.&sect;
  str = str.replace(/¨/g, "-", str); //Diéresis.&uml;
  str = str.replace(/©/g, "-", str); //Signo de derecho de copia.&copy;
  str = str.replace(/ª/g, "-", str); //Indicador ordinal femenino.&ordf;
  str = str.replace(/«/g, "-", str); //Signo de comillas francesas de apertura.&laquo;
  str = str.replace(/¬/g, "-", str); //Signo de negación.&not;
  str = str.replace(/®/g, "-", str); //Signo de marca registrada.&reg;
  str = str.replace(/¯/g, "&-", str); //Macrón.&macr;
  str = str.replace(/°/g, "-", str); //Signo de grado.&deg;
  str = str.replace(/±/g, "-", str); //Signo de más-menos.&plusmn;
  str = str.replace(/²/g, "-", str); //Superíndice dos.&sup2;
  str = str.replace(/³/g, "-", str); //Superíndice tres.&sup3;
  str = str.replace(/´/g, "-", str); //Acento agudo.&acute;
  str = str.replace(/µ/g, "-", str); //Signo de micro.&micro;
  str = str.replace(/¶/g, "-", str); //Signo de calderón.&para;
  str = str.replace(/·/g, "-", str); //Punto centrado.&middot;
  str = str.replace(/¸/g, "-", str); //Cedilla.&cedil;
  str = str.replace(/¹/g, "-", str); //Superíndice 1.&sup1;
  str = str.replace(/º/g, "-", str); //Indicador ordinal masculino.&ordm;
  str = str.replace(/»/g, "-", str); //Signo de comillas francesas de cierre.&raquo;
  str = str.replace(/¼/g, "-", str); //Fracción vulgar de un cuarto.&frac14;
  str = str.replace(/½/g, "-", str); //Fracción vulgar de un medio.&frac12;
  str = str.replace(/¾/g, "-", str); //Fracción vulgar de tres cuartos.&frac34;
  str = str.replace(/¿/g, "-", str); //Signo de interrogación abierta.&iquest;
  str = str.replace(/×/g, "-", str); //Signo de multiplicación.&times;
  str = str.replace(/÷/g, "-", str); //Signo de división.&divide;
  str = str.replace(/À/g, "a", str); //A mayúscula con acento grave.&Agrave;
  str = str.replace(/Á/g, "a", str); //A mayúscula con acento agudo.&Aacute;
  str = str.replace(/Â/g, "a", str); //A mayúscula con circunflejo.&Acirc;
  str = str.replace(/Ã/g, "a", str); //A mayúscula con tilde.&Atilde;
  str = str.replace(/Ä/g, "a", str); //A mayúscula con diéresis.&Auml;
  str = str.replace(/Å/g, "a", str); //A mayúscula con círculo encima.&Aring;
  str = str.replace(/Æ/g, "a", str); //AE mayúscula.&AElig;
  str = str.replace(/Ç/g, "c", str); //C mayúscula con cedilla.&Ccedil;
  str = str.replace(/È/g, "e", str); //E mayúscula con acento grave.&Egrave;
  str = str.replace(/É/g, "e", str); //E mayúscula con acento agudo.&Eacute;
  str = str.replace(/Ê/g, "e", str); //E mayúscula con circunflejo.&Ecirc;
  str = str.replace(/Ë/g, "e", str); //E mayúscula con diéresis.&Euml;
  str = str.replace(/Ì/g, "i", str); //I mayúscula con acento grave.&Igrave;
  str = str.replace(/Í/g, "i", str); //I mayúscula con acento agudo.&Iacute;
  str = str.replace(/Î/g, "i", str); //I mayúscula con circunflejo.&Icirc;
  str = str.replace(/Ï/g, "i", str); //I mayúscula con diéresis.&Iuml;
  str = str.replace(/Ð/g, "d", str); //ETH mayúscula.&ETH;
  str = str.replace(/Ñ/g, "n", str); //N mayúscula con tilde.&Ntilde;
  str = str.replace(/Ò/g, "o", str); //O mayúscula con acento grave.&Ograve;
  str = str.replace(/Ó/g, "o", str); //O mayúscula con acento agudo.&Oacute;
  str = str.replace(/Ô/g, "o", str); //O mayúscula con circunflejo.&Ocirc;
  str = str.replace(/Õ/g, "o", str); //O mayúscula con tilde.&Otilde;
  str = str.replace(/Ö/g, "o", str); //O mayúscula con diéresis.&Ouml;
  str = str.replace(/Ø/g, "o", str); //O mayúscula con barra inclinada.&Oslash;
  str = str.replace(/Ù/g, "u", str); //U mayúscula con acento grave.&Ugrave;
  str = str.replace(/Ú/g, "u", str); //U mayúscula con acento agudo.&Uacute;
  str = str.replace(/Û/g, "u", str); //U mayúscula con circunflejo.&Ucirc;
  str = str.replace(/Ü/g, "u", str); //U mayúscula con diéresis.&Uuml;
  str = str.replace(/Ý/g, "y", str); //Y mayúscula con acento agudo.&Yacute;
  str = str.replace(/Þ/g, "b", str); //Thorn mayúscula.&THORN;
  str = str.replace(/ß/g, "b", str); //S aguda alemana.&szlig;
  str = str.replace(/à/g, "a", str); //a minúscula con acento grave.&agrave;
  str = str.replace(/á/g, "a", str); //a minúscula con acento agudo.&aacute;
  str = str.replace(/â/g, "a", str); //a minúscula con circunflejo.&acirc;
  str = str.replace(/ã/g, "a", str); //a minúscula con tilde.&atilde;
  str = str.replace(/ä/g, "a", str); //a minúscula con diéresis.&auml;
  str = str.replace(/å/g, "a", str); //a minúscula con círculo encima.&aring;
  str = str.replace(/æ/g, "a", str); //ae minúscula.&aelig;
  str = str.replace(/ç/g, "a", str); //c minúscula con cedilla.&ccedil;
  str = str.replace(/è/g, "e", str); //e minúscula con acento grave.&egrave;
  str = str.replace(/é/g, "e", str); //e minúscula con acento agudo.&eacute;
  str = str.replace(/ê/g, "e", str); //e minúscula con circunflejo.&ecirc;
  str = str.replace(/ë/g, "e", str); //e minúscula con diéresis.&euml;
  str = str.replace(/ì/g, "i", str); //i minúscula con acento grave.&igrave;
  str = str.replace(/í/g, "i", str); //i minúscula con acento agudo.&iacute;
  str = str.replace(/î/g, "i", str); //i minúscula con circunflejo.&icirc;
  str = str.replace(/ï/g, "i", str); //i minúscula con diéresis.&iuml;
  str = str.replace(/ð/g, "i", str); //eth minúscula.&eth;
  str = str.replace(/ñ/g, "n", str); //n minúscula con tilde.&ntilde;
  str = str.replace(/ò/g, "o", str); //o minúscula con acento grave.&ograve;
  str = str.replace(/ó/g, "o", str); //o minúscula con acento agudo.&oacute;
  str = str.replace(/ô/g, "o", str); //o minúscula con circunflejo.&ocirc;
  str = str.replace(/õ/g, "o", str); //o minúscula con tilde.&otilde;
  str = str.replace(/ö/g, "o", str); //o minúscula con diéresis.&ouml;
  str = str.replace(/ø/g, "o", str); //o minúscula con barra inclinada.&oslash;
  str = str.replace(/ù/g, "o", str); //u minúscula con acento grave.&ugrave;
  str = str.replace(/ú/g, "u", str); //u minúscula con acento agudo.&uacute;
  str = str.replace(/û/g, "u", str); //u minúscula con circunflejo.&ucirc;
  str = str.replace(/ü/g, "u", str); //u minúscula con diéresis.&uuml;
  str = str.replace(/ý/g, "y", str); //y minúscula con acento agudo.&yacute;
  str = str.replace(/þ/g, "b", str); //thorn minúscula.&thorn;
  str = str.replace(/ÿ/g, "y", str); //y minúscula con diéresis.&yuml;
  str = str.replace(/Œ/g, "d", str); //OE Mayúscula.&OElig;
  str = str.replace(/œ/g, "-", str); //oe minúscula.&oelig;
  str = str.replace(/Ÿ/g, "-", str); //Y mayúscula con diéresis.&Yuml;
  str = str.replace(/ˆ/g, "", str); //Acento circunflejo.&circ;
  str = str.replace(/˜/g, "", str); //Tilde.&tilde;
  str = str.replace(/–/g, "", str); //Guiún corto.&ndash;
  str = str.replace(/—/g, "", str); //Guiún largo.&mdash;
  str = str.replace(/'/g, "", str); //Comilla simple izquierda.&lsquo;
  str = str.replace(/'/g, "", str); //Comilla simple derecha.&rsquo;
  str = str.replace(/,/g, "", str); //Comilla simple inferior.&sbquo;
  str = str.replace(/"/g, "", str); //Comillas doble derecha.&rdquo;
  str = str.replace(/"/g, "", str); //Comillas doble inferior.&bdquo;
  str = str.replace(/†/g, "-", str); //Daga.&dagger;
  str = str.replace(/‡/g, "-", str); //Daga doble.&Dagger;
  str = str.replace(/…/g, "-", str); //Elipsis horizontal.&hellip;
  str = str.replace(/‰/g, "-", str); //Signo de por mil.&permil;
  str = str.replace(/‹/g, "-", str); //Signo izquierdo de una cita.&lsaquo;
  str = str.replace(/›/g, "-", str); //Signo derecho de una cita.&rsaquo;
  str = str.replace(/€/g, "-", str); //Euro.&euro;
  str = str.replace(/™/g, "-", str); //Marca registrada.&trade;
  str = str.replace(/ & /g, "-", str); //Marca registrada.&trade;
  str = str.replace(/\(/g, "-", str);
  str = str.replace(/\)/g, "-", str);
  str = str.replace(/�/g, "-", str);
  str = str.replace(/\//g, "-", str);
  str = str.replace(/ de /g, "-", str); //Espacios
  str = str.replace(/ y /g, "-", str); //Espacios
  str = str.replace(/ a /g, "-", str); //Espacios
  str = str.replace(/ DE /g, "-", str); //Espacios
  str = str.replace(/ A /g, "-", str); //Espacios
  str = str.replace(/ Y /g, "-", str); //Espacios
  str = str.replace(/ /g, "-", str); //Espacios
  str = str.replace(/  /g, "-", str); //Espacios
  str = str.replace(/\./g, "", str); //Punto

  //Mayusculas
  str = str.toLowerCase();

  return str;
}

async function getTaxs(id) {
  let logo = await fetch(`get/tax.php?id=${id}`)
    .then((res) => res.json())
    .then((data) => data);
  return logo;
}

if (document.querySelector(".production")) {
  let list = document.querySelector(".grid-projects");
  list.innerHTML = "";
  async function getMovies() {
    let url, type;
    if (typeProd == "1") {
      url = "get/movies.php?propia=" + propiaProd;
      type = "pelicula";
    } else {
      url = "get/temporadas.php?propia=" + propiaProd;
      type = "serie";
    }

    await fetch(url)
      .then((res) => res.json())
      .then(async (allItems) => {
        if (typeProd != "1") {
          let newArray = [];

          for (let i = 0; i < allItems.series.length; i++) {
            let series = allItems.series[i];
            let temporadas = series.field_temporadas.split(", ");
            let temporadasNuevas = [];

            for (let j = 0; j < temporadas.length; j++) {
              for (let k = 0; k < allItems.temporadas.length; k++) {
                if (temporadas[j] === allItems.temporadas[k].nid) {
                  temporadasNuevas.push(allItems.temporadas[k]);
                }
              }
            }

            newArray.push({
              title: series.title,
              temporadas: temporadasNuevas,
            });
          }
          if (allItems.temporadas.length < 3) {
            document.querySelector(".recents").style.display = "none";
          }

          for (let index = 0; index < newArray.length; index++) {
            const serie = newArray[index];
            let festivales, plataformas;
            const element = newArray[index].temporadas[0];
            if (element) {
              if (element.field_premios) {
                festivales = await getFestivalesPlataformas(
                  element,
                  "field_premios",1
                );
              }
              /*if (element.field_plataforma) {
                plataformas = await getFestivalesPlataformas(
                  element,
                  "field_plataforma"
                );
              }*/
              let template = `
              <li>
              <a href="/${type}/${get_alias(serie.title)}-${element.nid}">
                <img src="${globalURL}${element.field_banner}" alt="${
                serie.title
              }" />
                <div class="overlay">
                  <div class="top">
                    <h4>${serie.title}</h4>
                    <h5>CREADO POR</h5>
                    <h5>${element.field_creado_por}</h5>
                    <h6>${element.field_paises} / ${element.field_year} / ${
                element.field_duracion
              }</h6>
                    <p>${element.field_cliente}</p>
                  </div>
                  <div class="logos">
                    <div class="festivales">
                    ${festivales ? festivales : ""}
                    </div>
                    <div class="platforms">
                    ${plataformas ? plataformas : ""}
                    </div>
                  </div>
                </div>
              </a>
            </li>
              `;
              list.innerHTML += template;
            }
          }
        } else {
          if (allItems.length < 3) {
            document.querySelector(".recents").style.display = "none";
          } else {
            for (let index = 0; index < 3; index++) {
              const element = allItems[index];
              const festivales = await getFestivalesPlataformas(
                element,
                "field_premios",1
              );

              /*const plataformas = await getFestivalesPlataformas(
                element,
                "field_plataforma"
              );*/

              let template = `
              <li>
              <a href="/${type}/${get_alias(element.title)}-${element.nid}">
                <img src="${
                  element.field_banner
                    ? `${globalURL}${element.field_banner}`
                    : "https://via.placeholder.com/634x330/?text=NO%20IMAGE"
                }" alt="${element.title}" />
                <div class="overlay">
                  <div class="top">
                    <h4>${element.title}</h4>
                    ${
                      element.field_creado_por
                        ? `<h5>${element.field_creado_por}</h5>`
                        : ``
                    }
                    
                    <h6>${element.field_paises} / ${element.field_year} / ${
                element.field_duracion
              }</h6>
                    <p>${element.field_cliente}</p>
                  </div>
                  <div class="logos">
                    <div class="festivales">
                    ${festivales ? festivales : ""}
                    </div>
                    <div class="platforms">
                    
                    </div>
                  </div>
                </div>
              </a>
            </li>
              `;
              //${plataformas ? plataformas : ""}
              document.querySelector(".recents .grid-recents").innerHTML +=
                template;
            }
          }
          for (let index = 0; index < allItems.length; index++) {
            const element = allItems[index];
            const festivales = await getFestivalesPlataformas(
              element,
              "field_premios"
            );
            const plataformas = await getFestivalesPlataformas(
              element,
              "field_plataforma"
            );

            let template = `
            <li>
            <a href="/${type}/${get_alias(element.title)}-${element.nid}">
              <img src="${
                element.field_banner
                  ? `${globalURL}${element.field_banner}`
                  : "https://via.placeholder.com/634x330/?text=NO%20IMAGE"
              }" alt="${element.title}" />
              <div class="overlay">
                <div class="top">
                  <h4>${element.title}</h4>
                  ${
                    element.field_creado_por
                      ? `<h5>${element.field_creado_por}</h5>`
                      : ``
                  }
                  <h6>${element.field_paises} / ${element.field_year} / ${
              element.field_duracion
            }</h6>
                  <p>${element.field_cliente}</p>
                </div>
                <div class="logos">
                  <div class="festivales">
                  ${festivales ? festivales : ""}
                  </div>
                  <div class="platforms">
                  
                  </div>
                </div>
              </div>
            </a>
          </li>
            `;
            //${plataformas ? plataformas : ""}
            list.innerHTML += template;
          }
        }
      });
  }
  getMovies();
}

function changeLang(langCode) {
  var url = new URL(document.location);
  var pathArray = url.pathname.split("/");
  var currentLang = pathArray[1];

  if (currentLang === langCode) {
    return;
  }

  if (currentLang) {
    pathArray[1] = langCode;
  } else {
    pathArray.splice(1, 0, langCode);
  }

  url.pathname = pathArray.join("/");
  location.href = url.href;
}

function validateForms(formID, rules, messages) {
  $(`#${formID}`).validate({
    rules,
    messages,
    submitHandler: function (form, event) {
      event.preventDefault();
      uploadFile();
      $(`#${formID} button[type="submit"]`).prop("disabled", true);
      $(`#${formID} button[type="submit"]`).addClass("loading");
      $(`#${formID} button[type="submit"]`).html("");
      $(`#${formID}`).ajaxSubmit({
        dataType: "json",
        success: function (data) {
          form.reset();
          $(`#${formID} button[type="submit"]`).prop("disabled", false);
          $(`#${formID} button[type="submit"]`).removeClass("loading");
          $(`#${formID} button[type="submit"]`).html("Enviado");
          Fancybox.close();
          Fancybox.show([{ src: "boxes/thanks.php", type: "ajax" }]);
        },
      });
    },
  });
  if (document.getElementById("file")) {
    document.getElementById("file").addEventListener("change", function () {
      const file = this.files[0];
      console.log(file);
      document.getElementById("file").setAttribute("data-after", file.name);
    });
  }
  if (document.getElementById("portafolio")) {
    document
      .getElementById("portafolio")
      .addEventListener("change", function () {
        const file = this.files[0];
        console.log(file);
        document
          .getElementById("portafolio")
          .setAttribute("data-after", file.name);
      });
  }
  if (document.getElementById("file2")) {
    document.getElementById("file2").addEventListener("change", function () {
      const file = this.files[0];
      console.log(file);
      document.getElementById("file2").setAttribute("data-after", file.name);
    });
  }
  customSelect();
}

// Upload file
function uploadFile() {
  if (document.querySelector("#file")) {
    var files = document.getElementById("file").files;

    if (files.length > 0) {
      var formData = new FormData();
      formData.append("file", files[0]);

      var xhttp = new XMLHttpRequest();
      // Set POST method and ajax file path
      xhttp.open("POST", "ajaxfile.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var response = this.responseText;
          if (response == 1) {
            console.log("Upload successfully.");
          } else {
            console.log("File not uploaded.");
          }
        }
      };
      xhttp.send(formData);
    }
  }
  if (document.querySelector("#portafolio")) {
    var files = document.getElementById("portafolio").files;

    if (files.length > 0) {
      var formData = new FormData();
      formData.append("portafolio", files[0]);

      var xhttp = new XMLHttpRequest();
      // Set POST method and ajax file path
      xhttp.open("POST", "ajaxfile.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var response = this.responseText;
          if (response == 1) {
            console.log("Upload successfully.");
          } else {
            console.log("File not uploaded.");
          }
        }
      };
      xhttp.send(formData);
    }
  }
  if (document.querySelector("#file2")) {
    var files = document.getElementById("file2").files;

    if (files.length > 0) {
      var formData = new FormData();
      formData.append("file2", files[0]);

      var xhttp = new XMLHttpRequest();
      // Set POST method and ajax file path
      xhttp.open("POST", "ajaxfile.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var response = this.responseText;
          if (response == 1) {
            console.log("Upload successfully.");
          } else {
            console.log("File not uploaded.");
          }
        }
      };
      xhttp.send(formData);
    }
  }
}
var vacantesCache = [];
if (document.querySelector("#vacante")) {
  //New autocomplete whouses function
  $("#vacante")
    .autocomplete({
      minLength: 0,
      source: function (request, response) {
        $.getJSON("get/vacantes.php", request, function (data, status, xhr) {
          vacantesCache = data;
          response(data);
        });
      },
      focus: function (event, ui) {
        $("#" + event.target.id).val(`${ui.item.title}-${ui.item.nid}`);
        return false;
      },
      select: function (event, ui) {
        var targetelement = $("#" + event.target.id);
        targetelement.val(`${ui.item.title}-${ui.item.nid}`);
        $(targetelement.data("targ")).val(`${ui.item.title}-${ui.item.nid}`);
        $(targetelement.data("targ")).trigger("change");

        return false;
      },
    })
    .autocomplete("instance")._renderItem = function (ul, item) {
    return $("<li>")
      .append("<div>" + item.title + "</div>")
      .appendTo(ul);
  };
}
function customSelect() {
  var x, i, j, l, ll, selElmnt, a, b, c;

  /*look for any elements with the class "custom-select":*/

  x = document.getElementsByClassName("custom-select");

  l = x.length;

  for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];

    ll = selElmnt.length;

    /*for each element, create a new DIV that will act as the selected item:*/

    a = document.createElement("DIV");

    a.setAttribute("class", "select-selected");

    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;

    x[i].appendChild(a);

    /*for each element, create a new DIV that will contain the option list:*/

    b = document.createElement("DIV");

    b.setAttribute("class", "select-items select-hide");

    for (j = 1; j < ll; j++) {
      /*for each option in the original select element,

      create a new DIV that will act as an option item:*/

      c = document.createElement("DIV");

      c.innerHTML = selElmnt.options[j].innerHTML;

      c.addEventListener("click", function (e) {
        /*when an item is clicked, update the original select box,

          and the selected item:*/

        var y, i, k, s, h, sl, yl;

        s = this.parentNode.parentNode.getElementsByTagName("select")[0];

        sl = s.length;

        h = this.parentNode.previousSibling;

        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;

            h.innerHTML = this.innerHTML;

            y = this.parentNode.getElementsByClassName("same-as-selected");

            yl = y.length;

            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }

            this.setAttribute("class", "same-as-selected");

            break;
          }
        }

        h.click();
      });

      b.appendChild(c);
    }

    x[i].appendChild(b);

    a.addEventListener("click", function (e) {
      /*when the select box is clicked, close any other select boxes,

        and open/close the current select box:*/

      e.stopPropagation();

      closeAllSelect(this);

      this.nextSibling.classList.toggle("select-hide");

      this.classList.toggle("select-arrow-active");
    });
  }

  function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,

    except the current select box:*/

    var x,
      y,
      i,
      xl,
      yl,
      arrNo = [];

    x = document.getElementsByClassName("select-items");

    y = document.getElementsByClassName("select-selected");

    xl = x.length;

    yl = y.length;

    for (i = 0; i < yl; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i);
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }

    for (i = 0; i < xl; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }

  /*if the user clicks anywhere outside the select box,

  then close all select boxes:*/

  document.addEventListener("click", closeAllSelect);
}
