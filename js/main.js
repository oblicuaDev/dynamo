let globalURL = "https://dynamo.mottif.tv";
const updateLoadingBar = (percent) => {
  document.getElementById("loading-bar").style.width = `${percent}%`;
};

const getFestivalesPlataformas = async (element, type, q = 0) => {
  let logos = [];

  if (element[type] != "" && element[type] != undefined) {
    let festivales = element[type].split(", ");
    let limit = festivales.length;
    if (q > 0) {
      limit = 1;
    }

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
            link =
              element.field_link_noticia ||
              `/noticias/${get_alias(element.title)}-${element.nid}`;
            let template = `
            <li class="slider-4-item splide__slide">
              <div class="text">
              <p>
              ${element.title}
              </p>
                <small>${element.field_fecha}</small>
                <a href="${element.field_link_noticia}" target="_blank" class="btn nobg">VER M??S</a>
              </div>
              <div class="image">
                <img src="${globalURL}${element.field_image}" alt="${element.title}" />
              </div>
            </li>`;
            list.innerHTML += template;
          });
        })
        .then(() =>
          new Splide(".slider-4", {
            pagination: false,
          }).mount()
        );
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
  setTimeout(() => {
    document.getElementById("preloader").classList.add("hidden");
  }, 600);
});
let typesContent = ["Pel??culas", "Temporadas", "Noticias"];
if (document.querySelector(".banner-home")) {
  const getBannersHome = async () => {
    // Build the URLs for the API calls
    const urls = infoGnrl.field_banners_home
      .split(", ")
      .map((id) => `get/banners.php?id=${id}`);

    // Make the API calls and get the responses
    const arrayOfResponses = await Promise.all(
      urls.map(async (url) => {
        const response = await fetch(url);
        return response.json();
      })
    );

    // Map the responses to the desired data structure
    const dataMap = await Promise.all(
      arrayOfResponses.map(async (banner) => {
        let link, festivales, plataformas;

        const commonFields = {
          image: `${globalURL}${banner.field_banner || banner.field_image}`,
          name: banner.title,
        };

        switch (banner.type) {
          case typesContent[0]: // Pel??culas
          case typesContent[1]: // Temporadas
            let typeText =
              banner.type == "Pel??culas"
                ? "pelicula"
                : banner.type == "Temporadas"
                ? "serie"
                : "";
            link = `/${typeText}/${get_alias(banner.title)}-${banner.nid}`;
            festivales = await getFestivalesPlataformas(
              banner,
              "field_premios"
            );
            plataformas = await getFestivalesPlataformas(
              banner,
              "field_plataforma"
            );
            return {
              ...commonFields,
              countries: banner.field_paises,
              year: banner.field_year,
              time: banner.field_duracion,
              director: banner.field_cliente,
              festivals: festivales,
              platfforms: plataformas,
              link: link,
            };

          case typesContent[2]: // Noticias
            link =
              banner.field_link_noticia ||
              `/${banner.type.toLowerCase()}/${get_alias(banner.title)}-${
                banner.nid
              }`;
            return {
              ...commonFields,
              link: link,
            };

          default:
            return null;
        }
      })
    );

    const filteredDataMap = dataMap.filter((data) => data !== null);

    return filteredDataMap;
  };

  // Use the getBannersHome function

  getBannersHome()
    .then((arraybanners) => {
      let index = 0;
      let timeSlider = 4000;
      let dots = document.getElementById("dots");
      arraybanners.map((banner, i) => {
        dots.innerHTML += `<div class="dot" data-dotindex="${i}"><div class="dot-fill"></div></div>`;
      });
      let dotElements = document.querySelectorAll(".dot");
      dotElements.forEach((dot) => {
        dot.addEventListener("click", () => {
          console.log("CLICK");
          animationStart(dot.dataset.dotindex);
        });
      });
      function animationStart(setIndex = null) {
        if (setIndex) {
          index = setIndex;
        }
        document.querySelector(
          ".banner-home .btn.more"
        ).href = `${arraybanners[index].link}`;
        document.querySelector(
          ".banner-home img"
        ).src = `${arraybanners[index].image}`;
        document.querySelector(
          ".info .top h2"
        ).innerHTML = `${arraybanners[index].name}`;
        document.querySelector(".director strong").innerHTML = `${
          arraybanners[index].field_cliente
            ? arraybanners[index].field_cliente
            : ``
        }`;
        document.querySelector(".director p").innerHTML = `${
          arraybanners[index].countries &&
          arraybanners[index].year &&
          arraybanners[index].time
            ? `${arraybanners[index].countries} / ${arraybanners[index].year} / ${arraybanners[index].time}`
            : ``
        }`;
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
}
if (document.querySelector(".banner-production")) {
  async function getAllInfoBannersProductions() {
    let arraybannersProductions = await Promise.all(
      arrayOfResponses.map(async (banner) => {
        const festivales = await getFestivalesPlataformas(
          banner,
          "field_premios"
        );
        const plataformas = await getFestivalesPlataformas(
          banner,
          "field_plataforma"
        );
        let typeText =
          typeProd == "1" ? "pelicula" : typeProd == "2" ? "serie" : "";
        let link = `/${typeText}/${get_alias(banner.title)}-${banner.nid}`;

        return {
          nid: banner.nid,
          image: `${globalURL}${banner.field_banner}`,
          name: banner.title,
          countries: banner.field_paises,
          year: banner.field_year,
          time: banner.field_duracion,
          director: banner.field_creado_por,
          cliente: banner.field_cliente,
          link: link,
          festivales: festivales,
          plataformas: plataformas,
        };
      })
    );
    let index = 0;
    let timeSlider = 4000;
    let dots = document.getElementById("dots");
    arraybannersProductions.map((banner, i) => {
      dots.innerHTML += `<div class="dot" data-dotindex="${i}"><div class="dot-fill"></div></div>`;
    });
    let dotElements = document.querySelectorAll(".dot");
    dotElements.forEach((dot) => {
      dot.addEventListener("click", () => {
        console.log("CLICK");
        animationStart(dot.dataset.dotindex);
      });
    });
    function animationStart(setIndex = null) {
      if (setIndex) {
        index = setIndex;
      }
      document.querySelector(
        ".banner-production .btn.more"
      ).href = `${arraybannersProductions[index].link}`;
      document.querySelector(
        ".banner-production img"
      ).src = `${arraybannersProductions[index].image}`;
      document.querySelector(
        ".info .top h2"
      ).innerHTML = `${arraybannersProductions[index].name}`;
      document.querySelector(
        ".director strong"
      ).innerHTML = `${arraybannersProductions[index].director}`;
      document.querySelector(
        ".director span"
      ).innerHTML = `${arraybannersProductions[index].cliente}`;
      document.querySelector(
        ".festivales"
      ).innerHTML = `${arraybannersProductions[index].festivales}`;
      document.querySelector(
        ".platforms"
      ).innerHTML = `${arraybannersProductions[index].plataformas}`;

      document.querySelector(".director p").innerHTML = `${
        arraybannersProductions[index].countries &&
        arraybannersProductions[index].year &&
        arraybannersProductions[index].time
          ? `${arraybannersProductions[index].countries} / ${arraybannersProductions[index].year} / ${arraybannersProductions[index].time}`
          : ``
      }`;
      dotElements[index].classList.add("active");

      if (index == arraybannersProductions.length - 1) {
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
  }
  getAllInfoBannersProductions();
}

function get_alias(str) {
  str = str.replace(/??/g, "", str); //Signo de exclamaci??n abierta.&iexcl;
  str = str.replace(/'/g, "", str); //Signo de exclamaci??n abierta.&iexcl;
  str = str.replace(/!/g, "", str); //Signo de exclamaci??n abierta.&iexcl;
  str = str.replace(/??/g, "-", str); //Signo de centavo.&cent;
  str = str.replace(/??/g, "-", str); //Signo de libra esterlina.&pound;
  str = str.replace(/??/g, "-", str); //Signo monetario.&curren;
  str = str.replace(/??/g, "-", str); //Signo del yen.&yen;
  str = str.replace(/??/g, "-", str); //Barra vertical partida.&brvbar;
  str = str.replace(/??/g, "-", str); //Signo de secci??n.&sect;
  str = str.replace(/??/g, "-", str); //Di??resis.&uml;
  str = str.replace(/??/g, "-", str); //Signo de derecho de copia.&copy;
  str = str.replace(/??/g, "-", str); //Indicador ordinal femenino.&ordf;
  str = str.replace(/??/g, "-", str); //Signo de comillas francesas de apertura.&laquo;
  str = str.replace(/??/g, "-", str); //Signo de negaci??n.&not;
  str = str.replace(/??/g, "-", str); //Signo de marca registrada.&reg;
  str = str.replace(/??/g, "&-", str); //Macr??n.&macr;
  str = str.replace(/??/g, "-", str); //Signo de grado.&deg;
  str = str.replace(/??/g, "-", str); //Signo de m??s-menos.&plusmn;
  str = str.replace(/??/g, "-", str); //Super??ndice dos.&sup2;
  str = str.replace(/??/g, "-", str); //Super??ndice tres.&sup3;
  str = str.replace(/??/g, "-", str); //Acento agudo.&acute;
  str = str.replace(/??/g, "-", str); //Signo de micro.&micro;
  str = str.replace(/??/g, "-", str); //Signo de calder??n.&para;
  str = str.replace(/??/g, "-", str); //Punto centrado.&middot;
  str = str.replace(/??/g, "-", str); //Cedilla.&cedil;
  str = str.replace(/??/g, "-", str); //Super??ndice 1.&sup1;
  str = str.replace(/??/g, "-", str); //Indicador ordinal masculino.&ordm;
  str = str.replace(/??/g, "-", str); //Signo de comillas francesas de cierre.&raquo;
  str = str.replace(/??/g, "-", str); //Fracci??n vulgar de un cuarto.&frac14;
  str = str.replace(/??/g, "-", str); //Fracci??n vulgar de un medio.&frac12;
  str = str.replace(/??/g, "-", str); //Fracci??n vulgar de tres cuartos.&frac34;
  str = str.replace(/??/g, "-", str); //Signo de interrogaci??n abierta.&iquest;
  str = str.replace(/??/g, "-", str); //Signo de multiplicaci??n.&times;
  str = str.replace(/??/g, "-", str); //Signo de divisi??n.&divide;
  str = str.replace(/??/g, "a", str); //A may??scula con acento grave.&Agrave;
  str = str.replace(/??/g, "a", str); //A may??scula con acento agudo.&Aacute;
  str = str.replace(/??/g, "a", str); //A may??scula con circunflejo.&Acirc;
  str = str.replace(/??/g, "a", str); //A may??scula con tilde.&Atilde;
  str = str.replace(/??/g, "a", str); //A may??scula con di??resis.&Auml;
  str = str.replace(/??/g, "a", str); //A may??scula con c??rculo encima.&Aring;
  str = str.replace(/??/g, "a", str); //AE may??scula.&AElig;
  str = str.replace(/??/g, "c", str); //C may??scula con cedilla.&Ccedil;
  str = str.replace(/??/g, "e", str); //E may??scula con acento grave.&Egrave;
  str = str.replace(/??/g, "e", str); //E may??scula con acento agudo.&Eacute;
  str = str.replace(/??/g, "e", str); //E may??scula con circunflejo.&Ecirc;
  str = str.replace(/??/g, "e", str); //E may??scula con di??resis.&Euml;
  str = str.replace(/??/g, "i", str); //I may??scula con acento grave.&Igrave;
  str = str.replace(/??/g, "i", str); //I may??scula con acento agudo.&Iacute;
  str = str.replace(/??/g, "i", str); //I may??scula con circunflejo.&Icirc;
  str = str.replace(/??/g, "i", str); //I may??scula con di??resis.&Iuml;
  str = str.replace(/??/g, "d", str); //ETH may??scula.&ETH;
  str = str.replace(/??/g, "n", str); //N may??scula con tilde.&Ntilde;
  str = str.replace(/??/g, "o", str); //O may??scula con acento grave.&Ograve;
  str = str.replace(/??/g, "o", str); //O may??scula con acento agudo.&Oacute;
  str = str.replace(/??/g, "o", str); //O may??scula con circunflejo.&Ocirc;
  str = str.replace(/??/g, "o", str); //O may??scula con tilde.&Otilde;
  str = str.replace(/??/g, "o", str); //O may??scula con di??resis.&Ouml;
  str = str.replace(/??/g, "o", str); //O may??scula con barra inclinada.&Oslash;
  str = str.replace(/??/g, "u", str); //U may??scula con acento grave.&Ugrave;
  str = str.replace(/??/g, "u", str); //U may??scula con acento agudo.&Uacute;
  str = str.replace(/??/g, "u", str); //U may??scula con circunflejo.&Ucirc;
  str = str.replace(/??/g, "u", str); //U may??scula con di??resis.&Uuml;
  str = str.replace(/??/g, "y", str); //Y may??scula con acento agudo.&Yacute;
  str = str.replace(/??/g, "b", str); //Thorn may??scula.&THORN;
  str = str.replace(/??/g, "b", str); //S aguda alemana.&szlig;
  str = str.replace(/??/g, "a", str); //a min??scula con acento grave.&agrave;
  str = str.replace(/??/g, "a", str); //a min??scula con acento agudo.&aacute;
  str = str.replace(/??/g, "a", str); //a min??scula con circunflejo.&acirc;
  str = str.replace(/??/g, "a", str); //a min??scula con tilde.&atilde;
  str = str.replace(/??/g, "a", str); //a min??scula con di??resis.&auml;
  str = str.replace(/??/g, "a", str); //a min??scula con c??rculo encima.&aring;
  str = str.replace(/??/g, "a", str); //ae min??scula.&aelig;
  str = str.replace(/??/g, "a", str); //c min??scula con cedilla.&ccedil;
  str = str.replace(/??/g, "e", str); //e min??scula con acento grave.&egrave;
  str = str.replace(/??/g, "e", str); //e min??scula con acento agudo.&eacute;
  str = str.replace(/??/g, "e", str); //e min??scula con circunflejo.&ecirc;
  str = str.replace(/??/g, "e", str); //e min??scula con di??resis.&euml;
  str = str.replace(/??/g, "i", str); //i min??scula con acento grave.&igrave;
  str = str.replace(/??/g, "i", str); //i min??scula con acento agudo.&iacute;
  str = str.replace(/??/g, "i", str); //i min??scula con circunflejo.&icirc;
  str = str.replace(/??/g, "i", str); //i min??scula con di??resis.&iuml;
  str = str.replace(/??/g, "i", str); //eth min??scula.&eth;
  str = str.replace(/??/g, "n", str); //n min??scula con tilde.&ntilde;
  str = str.replace(/??/g, "o", str); //o min??scula con acento grave.&ograve;
  str = str.replace(/??/g, "o", str); //o min??scula con acento agudo.&oacute;
  str = str.replace(/??/g, "o", str); //o min??scula con circunflejo.&ocirc;
  str = str.replace(/??/g, "o", str); //o min??scula con tilde.&otilde;
  str = str.replace(/??/g, "o", str); //o min??scula con di??resis.&ouml;
  str = str.replace(/??/g, "o", str); //o min??scula con barra inclinada.&oslash;
  str = str.replace(/??/g, "o", str); //u min??scula con acento grave.&ugrave;
  str = str.replace(/??/g, "u", str); //u min??scula con acento agudo.&uacute;
  str = str.replace(/??/g, "u", str); //u min??scula con circunflejo.&ucirc;
  str = str.replace(/??/g, "u", str); //u min??scula con di??resis.&uuml;
  str = str.replace(/??/g, "y", str); //y min??scula con acento agudo.&yacute;
  str = str.replace(/??/g, "b", str); //thorn min??scula.&thorn;
  str = str.replace(/??/g, "y", str); //y min??scula con di??resis.&yuml;
  str = str.replace(/??/g, "d", str); //OE May??scula.&OElig;
  str = str.replace(/??/g, "-", str); //oe min??scula.&oelig;
  str = str.replace(/??/g, "-", str); //Y may??scula con di??resis.&Yuml;
  str = str.replace(/??/g, "", str); //Acento circunflejo.&circ;
  str = str.replace(/??/g, "", str); //Tilde.&tilde;
  str = str.replace(/???/g, "", str); //Gui??n corto.&ndash;
  str = str.replace(/???/g, "", str); //Gui??n largo.&mdash;
  str = str.replace(/'/g, "", str); //Comilla simple izquierda.&lsquo;
  str = str.replace(/'/g, "", str); //Comilla simple derecha.&rsquo;
  str = str.replace(/,/g, "", str); //Comilla simple inferior.&sbquo;
  str = str.replace(/"/g, "", str); //Comillas doble derecha.&rdquo;
  str = str.replace(/"/g, "", str); //Comillas doble inferior.&bdquo;
  str = str.replace(/???/g, "-", str); //Daga.&dagger;
  str = str.replace(/???/g, "-", str); //Daga doble.&Dagger;
  str = str.replace(/???/g, "-", str); //Elipsis horizontal.&hellip;
  str = str.replace(/???/g, "-", str); //Signo de por mil.&permil;
  str = str.replace(/???/g, "-", str); //Signo izquierdo de una cita.&lsaquo;
  str = str.replace(/???/g, "-", str); //Signo derecho de una cita.&rsaquo;
  str = str.replace(/???/g, "-", str); //Euro.&euro;
  str = str.replace(/???/g, "-", str); //Marca registrada.&trade;
  str = str.replace(/ & /g, "-", str); //Marca registrada.&trade;
  str = str.replace(/\(/g, "-", str);
  str = str.replace(/\)/g, "-", str);
  str = str.replace(/???/g, "-", str);
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
                  "field_premios",
                  1
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
                "field_premios",
                1
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
                  
                  ${plataformas ? plataformas : ""}
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

if (document.querySelector(".banner-news")) {
  let index = 0;
  let timeSlider = 4000;
  let dots = document.getElementById("dots");
  arraybannersNews.map((banner, i) => {
    dots.innerHTML += `<div class="dot"><div class="dot-fill"></div></div>`;
  });
  let dotElements = document.querySelectorAll(".dot");

  function animationStart() {
    document.querySelector(
      ".banner-news .btn.more"
    ).href = `${arraybannersNews[index].link}`;
    document.querySelector(
      ".banner-news img"
    ).src = `${arraybannersNews[index].image}`;
    document.querySelector(
      ".info .top h2"
    ).innerHTML = `${arraybannersNews[index].name}`;
    document.querySelector(".director strong").innerHTML = `${
      arraybannersNews[index].field_cliente
        ? arraybannersNews[index].field_cliente
        : ``
    }`;
    document.querySelector(".director p").innerHTML = `${
      arraybannersNews[index].countries &&
      arraybannersNews[index].year &&
      arraybannersNews[index].time
        ? `${arraybannersNews[index].countries} / ${arraybannersNews[index].year} / ${arraybannersNews[index].time}`
        : ``
    }`;
    dotElements[index].classList.add("active");
    if (index == arraybannersNews.length - 1) {
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
}
