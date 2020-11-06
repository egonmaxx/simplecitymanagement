window.onload = function () {
  
    var app = new Vue({
    el: '#app',
    data: {
      message: "",
      countiesData: [],
      citiesData:[{"id": 0,"name":"No cities yet"}],
      countiesList: "",
      cityName: "",
      displayCityInput:null,
      displayCityText:null,
      translations: {},
    },
    methods: {
      reverseMessage: function () {
        this.message = this.message.split('').reverse().join('')
      },
      updateCityById: function (event) {
        if (event.target.value != '') {

        const cityNameAndId = {"name":event.target.value, "cityId":event.target.getAttribute('data-inputcityid')};

        axios.post('http://localhost:8080/updatecitynamebyid',cityNameAndId)
            .then((response) => {
              this.getAllCitiesByCountyId();
            }).catch(function (error) {
              alert(error);
        });
        } else {
          this.message = 'Empty city name is not allowed';
        }
      },
      finishCityUpdate: function () {
        this.displayCityInput=false;
        this.displayCityText=false;
        this.getAllCitiesByCountyId();
      },
      showInputCity: function (event) {
        if (event.target.getAttribute('data-textcityid') > 0 ) {
          this.displayCityInput = event.target.getAttribute('data-textcityid');
          this.displayCityText = event.target.getAttribute('data-textcityid');
        }
      },
      deleteCityById: function (event) {
        const cityId = {"cityId":event.target.getAttribute('data-cityid')};

        axios.post('http://localhost:8080/deletecitybyid',cityId)
            .then((response) => {
              this.getAllCitiesByCountyId();
            }).catch(function (error) {
              alert(error);
        });
      },
      addCityByCountyId:function () {
        if (this.countiesList == "") {
          this.citiesList = [{"id": 0,"name":this.translations.pleaseSelect}];
          this.message = this.translations.pleaseSelect;
        } else if (this.cityName == "") {
          this.message = this.translations.pleaseEnter;
        } else {
          this.message = '';
          const cityNameAndCountyId = {"name":this.cityName,"countyId":this.countiesList};
          axios.post('http://localhost:8080/addcitybycountyid',cityNameAndCountyId)
            .then((response) => {
              this.getAllCitiesByCountyId();
              this.cityName = "";
              console.log(response.data);
            }).catch(function (error) {
              alert(error);
            });
        }
      },
      getAllCitiesByCountyId: function () {
        if (this.countiesList == "") {
          this.message = this.translations.pleaseSelect;
          this.citiesData = [{"id": 0,"name":this.translations.noCity}];
        } else {
          this.message = '';
          const countyId = { countyId: this.countiesList };
          axios.post('http://localhost:8080/citiesbycounty',countyId)
            .then((response) => {
              this.citiesData = response.data;
              if (response.data.length == 0) {
                this.citiesData = [{"id": 0,"name":this.translations.noCity}];
              }
            }).catch(function (error) {
              alert(error);
            });
          }
      },
      getCounties: function () {
        axios.get('http://localhost:8080/counties')
          .then((response) => {
            this.countiesData = response.data;
          }).catch(function (error) {
            alert(error);
          });
      },
      getTranslations: function () {
        let userLang = navigator.language || navigator.userLanguage; 
        const language = {"language": userLang.split('-')[0]};
        //const language = {"language": 'hu'};
        axios.post('http://localhost:8080/gettranslation',language)
            .then((response) => {
              this .translations = response.data;
              document.title = this.translations.title;
              this.citiesData = [{"id": 0,"name":this.translations.noCity}];
            }).catch(function (error) {
              alert(error);
        });
      },
    },
    mounted: function () {
      this.getTranslations();
      this.getCounties();

      window.onclick = e => {

        if (e.target.className != 'city-name' && e.target.className != 'city-input' && app.displayCityInput != null) {
          app.finishCityUpdate();
        }
      } 
    }
  });

}