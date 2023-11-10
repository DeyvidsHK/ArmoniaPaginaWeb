window.onload = function () {
  const name = document.getElementById("name");
  const cardnumber = document.getElementById("cardnumber");
  const expirationdate = document.getElementById("expirationdate");
  const securitycode = document.getElementById("securitycode");
  const output = document.getElementById("output");
  const ccicon = document.getElementById("ccicon");
  const ccsingle = document.getElementById("ccsingle");
  const generatecard = document.getElementById("generatecard");

  let cctype = null;

  //Mask the Credit Card Number Input
  var cardnumber_mask = new IMask(cardnumber, {
    mask: [
      {
        mask: "0000 0000 0000 0000",
        regex: "^4\\d{0,15}",
        cardtype: "visa",
      },
    ],
    dispatch: function (appended, dynamicMasked) {
      var number = (dynamicMasked.value + appended).replace(/\D/g, "");

      for (var i = 0; i < dynamicMasked.compiledMasks.length; i++) {
        let re = new RegExp(dynamicMasked.compiledMasks[i].regex);
        if (number.match(re) != null) {
          return dynamicMasked.compiledMasks[i];
        }
      }
    },
  });

  //Mask the Expiration Date
  var expirationdate_mask = new IMask(expirationdate, {
    mask: "MM{/}YY",
    groups: {
      YY: new IMask.MaskedPattern.Group.Range([0, 99]),
      MM: new IMask.MaskedPattern.Group.Range([1, 12]),
    },
  });

  //Mask the security code
  var securitycode_mask = new IMask(securitycode, {
    mask: "0000",
  });

  // SVGICONS
  let visa = `<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="visa" fill-rule="nonzero"> <rect id="Rectangle-1" fill="#0E4595" x="0" y="0" width="750" height="471" rx="40"></rect> <polygon id="Shape" fill="#FFFFFF" points="278.1975 334.2275 311.5585 138.4655 364.9175 138.4655 331.5335 334.2275"></polygon> <path d="M524.3075,142.6875 C513.7355,138.7215 497.1715,134.4655 476.4845,134.4655 C423.7605,134.4655 386.6205,161.0165 386.3045,199.0695 C386.0075,227.1985 412.8185,242.8905 433.0585,252.2545 C453.8275,261.8495 460.8105,267.9695 460.7115,276.5375 C460.5795,289.6595 444.1255,295.6545 428.7885,295.6545 C407.4315,295.6545 396.0855,292.6875 378.5625,285.3785 L371.6865,282.2665 L364.1975,326.0905 C376.6605,331.5545 399.7065,336.2895 423.6355,336.5345 C479.7245,336.5345 516.1365,310.2875 516.5505,269.6525 C516.7515,247.3835 502.5355,230.4355 471.7515,216.4645 C453.1005,207.4085 441.6785,201.3655 441.7995,192.1955 C441.7995,184.0585 451.4675,175.3575 472.3565,175.3575 C489.8055,175.0865 502.4445,178.8915 512.2925,182.8575 L517.0745,185.1165 L524.3075,142.6875" id="path13" fill="#FFFFFF"></path> <path d="M661.6145,138.4655 L620.3835,138.4655 C607.6105,138.4655 598.0525,141.9515 592.4425,154.6995 L513.1975,334.1025 L569.2285,334.1025 C569.2285,334.1025 578.3905,309.9805 580.4625,304.6845 C586.5855,304.6845 641.0165,304.7685 648.7985,304.7685 C650.3945,311.6215 655.2905,334.1025 655.2905,334.1025 L704.8025,334.1025 L661.6145,138.4655 Z M596.1975,264.8725 C600.6105,253.5935 617.4565,210.1495 617.4565,210.1495 C617.1415,210.6705 621.8365,198.8155 624.5315,191.4655 L628.1385,208.3435 C628.1385,208.3435 638.3555,255.0725 640.4905,264.8715 L596.1975,264.8715 L596.1975,264.8725 Z" id="Path" fill="#FFFFFF"></path> <path d="M232.9025,138.4655 L180.6625,271.9605 L175.0965,244.8315 C165.3715,213.5575 135.0715,179.6755 101.1975,162.7125 L148.9645,333.9155 L205.4195,333.8505 L289.4235,138.4655 L232.9025,138.4655" id="path16" fill="#FFFFFF"></path> <path d="M131.9195,138.4655 L45.8785,138.4655 L45.1975,142.5385 C112.1365,158.7425 156.4295,197.9015 174.8155,244.9525 L156.1065,154.9925 C152.8765,142.5965 143.5085,138.8975 131.9195,138.4655" id="path18" fill="#F2AE14"></path> </g> </g>`;

  let visa_single = `<svg version="1.1" id="Layer_1" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="600px" height="321px" viewBox="0 0 750 471" enable-background="new 0 0 750 471" xml:space="preserve"><title>Slice 1</title><desc>Created with Sketch.</desc><g id="visa" sketch:type="MSLayerGroup"><path id="Shape" sketch:type="MSShapeGroup" fill="#0E4595" d="M278.198,334.228l33.36-195.763h53.358l-33.384,195.763H278.198L278.198,334.228z"/><path id="path13" sketch:type="MSShapeGroup" fill="#0E4595" d="M524.307,142.687c-10.57-3.966-27.135-8.222-47.822-8.222c-52.725,0-89.863,26.551-90.18,64.604c-0.297,28.129,26.514,43.821,46.754,53.185c20.77,9.597,27.752,15.716,27.652,24.283c-0.133,13.123-16.586,19.116-31.924,19.116c-21.355,0-32.701-2.967-50.225-10.274l-6.877-3.112l-7.488,43.823c12.463,5.466,35.508,10.199,59.438,10.445c56.09,0,92.502-26.248,92.916-66.884c0.199-22.27-14.016-39.216-44.801-53.188c-18.65-9.056-30.072-15.099-29.951-24.269c0-8.137,9.668-16.838,30.559-16.838c17.447-0.271,30.088,3.534,39.936,7.5l4.781,2.259L524.307,142.687"/><path id="Path" sketch:type="MSShapeGroup" fill="#0E4595" d="M661.615,138.464h-41.23c-12.773,0-22.332,3.486-27.941,16.234l-79.244,179.402h56.031c0,0,9.16-24.121,11.232-29.418c6.123,0,60.555,0.084,68.336,0.084c1.596,6.854,6.492,29.334,6.492,29.334h49.512L661.615,138.464L661.615,138.464z M596.198,264.872c4.414-11.279,21.26-54.724,21.26-54.724c-0.314,0.521,4.381-11.334,7.074-18.684l3.607,16.878c0,0,10.217,46.729,12.352,56.527h-44.293V264.872L596.198,264.872z"/><path id="path16" sketch:type="MSShapeGroup" fill="#0E4595" d="M232.903,138.464L180.664,271.96l-5.565-27.129c-9.726-31.274-40.025-65.157-73.898-82.12l47.767,171.204l56.455-0.064l84.004-195.386L232.903,138.464"/><path id="path18" sketch:type="MSShapeGroup" fill="#F2AE14" d="M131.92,138.464H45.879l-0.682,4.073c66.939,16.204,111.232,55.363,129.618,102.415l-18.709-89.96C152.877,142.596,143.509,138.896,131.92,138.464"/></g></svg>`;

  //define the color swap function
  const swapColor = function (basecolor) {
    document.querySelectorAll(".lightcolor").forEach(function (input) {
      input.setAttribute("class", "");
      input.setAttribute("class", "lightcolor " + basecolor);
    });
    document.querySelectorAll(".darkcolor").forEach(function (input) {
      input.setAttribute("class", "");
      input.setAttribute("class", "darkcolor " + basecolor + "dark");
    });
  };

  //pop in the appropriate card icon when detected
  cardnumber_mask.on("accept", function () {
    console.log(cardnumber_mask.masked.currentMask.cardtype);
    switch (cardnumber_mask.masked.currentMask.cardtype) {
      case "visa":
        ccicon.innerHTML = visa;
        ccsingle.innerHTML = visa_single;
        swapColor("lime");
        break;

      default:
        ccicon.innerHTML = "";
        ccsingle.innerHTML = "";
        swapColor("grey");
        break;
    }
  });

  //Generate random card number from list of known test numbers
  const randomCard = function () {
    let testCards = [
      "4000056655665556",
      "5200828282828210",
      "371449635398431",
      "6011000990139424",
      "30569309025904",
      "3566002020360505",
      "6200000000000005",
      "6759649826438453",
    ];
    let randomNumber = Math.floor(Math.random() * testCards.length);
    cardnumber_mask.unmaskedValue = testCards[randomNumber];
  };
  generatecard.addEventListener("click", function () {
    randomCard();
  });

  // CREDIT CARD IMAGE JS
  document.querySelector(".preload").classList.remove("preload");
  document.querySelector(".creditcard").addEventListener("click", function () {
    if (this.classList.contains("flipped")) {
      this.classList.remove("flipped");
    } else {
      this.classList.add("flipped");
    }
  });

  //On Input Change Events
  name.addEventListener("input", function () {
    if (name.value.length == 0) {
      document.getElementById("svgname").innerHTML = "John Doe";
      document.getElementById("svgnameback").innerHTML = "John Doe";
    } else {
      document.getElementById("svgname").innerHTML = this.value;
      document.getElementById("svgnameback").innerHTML = this.value;
    }
  });

  cardnumber_mask.on("accept", function () {
    if (cardnumber_mask.value.length == 0) {
      document.getElementById("svgnumber").innerHTML = "0123 4567 8910 1112";
    } else {
      document.getElementById("svgnumber").innerHTML = cardnumber_mask.value;
    }
  });

  expirationdate_mask.on("accept", function () {
    if (expirationdate_mask.value.length == 0) {
      document.getElementById("svgexpire").innerHTML = "01/23";
    } else {
      document.getElementById("svgexpire").innerHTML =
        expirationdate_mask.value;
    }
  });

  securitycode_mask.on("accept", function () {
    if (securitycode_mask.value.length == 0) {
      document.getElementById("svgsecurity").innerHTML = "985";
    } else {
      document.getElementById("svgsecurity").innerHTML =
        securitycode_mask.value;
    }
  });

  //On Focus Events
  name.addEventListener("focus", function () {
    document.querySelector(".creditcard").classList.remove("flipped");
  });

  cardnumber.addEventListener("focus", function () {
    document.querySelector(".creditcard").classList.remove("flipped");
  });

  expirationdate.addEventListener("focus", function () {
    document.querySelector(".creditcard").classList.remove("flipped");
  });

  securitycode.addEventListener("focus", function () {
    document.querySelector(".creditcard").classList.add("flipped");
  });
};
