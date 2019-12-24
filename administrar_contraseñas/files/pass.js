


function sendEmail(correo,newPass) {
	console.log(correo);
	Email.send({
		Host: "smtp.gmail.com",
		Username : "sistemamatriculatec@gmail.com",
		Password : "jeanvegadiaz",
		To : correo,
		From : "sistemamatriculatec@gmail.com",
		Subject : "Cambio de contraseña",
		Body : "Se ha generado una peticion para cambiar la contraseña de su cuenta \n\n Su nueva contraseña es: " + newPass,
	});
	console.log("eviado");
}