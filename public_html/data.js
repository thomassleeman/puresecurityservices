window.onscroll = () => {
  logoSize();
};

logoSize = () => {
  var logoStyle = document.getElementById("logo").style;

  if (
    (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) &&
    window.innerWidth <= 991
  ) {
    logoStyle.width = "calc(190px + 3vw)";
    logoStyle.transition = "500ms";
  } else if (
    (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) &&
    window.innerWidth > 991
  ) {
    logoStyle.width = "calc(150px + 3vw)";
    logoStyle.transition = "500ms";
  } else if (
    (document.body.scrollTop <= 50 ||
      document.documentElement.scrollTop <= 50) &&
    window.innerWidth <= 991
  ) {
    logoStyle.width = "calc(210px + 3vw)";
    logoStyle.transition = "500ms";
  } else if (
    (document.body.scrollTop <= 50 ||
      document.documentElement.scrollTop <= 50) &&
    window.innerWidth > 991
  ) {
    logoStyle.width = "calc(190px + 3vw)";
    logoStyle.transition = "500ms";
  }
};

//function above is to resize the logo and hence height of nav bar when scrolling down.

emailText = () => {
  const emailDisplay = document.getElementById("email-address");
  const emailFirst = "info";
  const emailSecond = "@pure";
  const emailThird = "security.co.uk";
  emailDisplay.innerHTML = emailFirst + emailSecond + emailThird;
};
emailText();

copyrightText = () => {
  const date = new Date();
  const year = date.getUTCFullYear();
  document.getElementById(
    "copyright"
  ).innerHTML = `Copyright &copy; ${year} Pure Security Ltd.`;
};
copyrightText();

// crmUpdate () => {
//   const yourName = document.getElementById("name").value;
//   const company = document.getElementById("company").value;
//   const email = document.getElementById("email").value;

// }
