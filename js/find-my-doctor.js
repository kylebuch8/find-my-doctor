$(function() {
	var FindMyDoctor = {
		Models : {},
		Views : {},
		Collections : {},
		init : function() {
			new FindMyDoctor.Views.Form;
		}
	};

	FindMyDoctor.Models.Doctor = Backbone.Model.extend({

	});

	FindMyDoctor.Collections.DoctorsList = Backbone.Collection.extend({
		model : FindMyDoctor.Models.Doctor
	});

	FindMyDoctor.Views.Form = Backbone.View.extend({
		el : $('#inputForm'),

		events : {
			'submit' : 'submitHandler'
		},

		submitHandler : function(event) {
			event.preventDefault();
			console.log('the form has been submitted');
		}
	});

	FindMyDoctor.init();
});