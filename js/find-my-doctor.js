$(function() {
	var FindMyDoctor = {
		Models : {},
		Views : {},
		Collections : {},
		init : function() {
			// set up the collection
			FindMyDoctor.Collections.Doctors = new FindMyDoctor.Collections.DoctorsList;

			// add the two views
			new FindMyDoctor.Views.Form;
			new FindMyDoctor.Views.Results;
		}
	};

	FindMyDoctor.Models.Doctor = Backbone.Model.extend({

	});

	FindMyDoctor.Collections.DoctorsList = Backbone.Collection.extend({
		model : FindMyDoctor.Models.Doctor,

		url : '/bcbsnc/find-my-doctor/api/index.php/findmydoctor/search'
	});

	FindMyDoctor.Views.Form = Backbone.View.extend({
		el : $('#inputForm'),

		nameInput : $('#doctorName'),

		events : {
			'submit' : 'submitHandler'
		},

		submitHandler : function(event) {
			event.preventDefault();

			FindMyDoctor.Collections.Doctors.fetch({
				data : {
					'query' : this.nameInput.val()
				},
				type : 'POST'
			});
		}
	});

	FindMyDoctor.Views.Result = Backbone.View.extend({
		tagName : 'div',

		className : 'result',

		template : _.template($('#result').html()),

		render : function() {
			this.$el.html(this.template(this.model.toJSON()));
			return this;
		}
	});

	FindMyDoctor.Views.Results = Backbone.View.extend({
		el : $('#results'),

		initialize : function() {
			FindMyDoctor.Collections.Doctors.bind('reset', this.dataLoadedHandler, this);
		},

		dataLoadedHandler : function() {
			var that = this;

			that.$el.empty();

			FindMyDoctor.Collections.Doctors.each(function(result) {
				var result = new FindMyDoctor.Views.Result({ model : result });
				that.$el.append(result.render().el);
			});
		}
	});

	FindMyDoctor.init();
});