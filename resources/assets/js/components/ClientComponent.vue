<template>
  <div id="client-cars">
    <div class="flex-center full-height">
      <div>
        <div class="uk-card uk-card-small uk-card-body">
          <fieldset class="uk-fieldset">
            <div class="uk-margin">
              <legend class="uk-legend">Search Current Car Prices</legend>
            </div>

            <div class="uk-margin">
              <div v-if="!cars">
                <legend>There are no availabe car/s yet.</legend>
              </div>
              <div v-else>
                <div class="uk-margin">
                  <legend>Select filter by Car Make.</legend>
                  <select class="uk-select" name id v-model="carMakeSelected">
                    <option value>Please select make to filter the listing</option>
                    <option v-for="make in carMakes" :key="make.id" v-bind:value="make">{{ make }}</option>
                  </select>
                </div>
                <div class="uk-margin" data-uk-grid>
                  <div class v-for="car in cars" :key="car.id">
                    <div class="uk-width-small-1-4">
                      <div class="uk-card uk-card-default uk-card-body">
                        <img
                          src="/imgs/2020-ford-ecosport-trend-06k220.jpg"
                          height="320px"
                          width="320px"
                          alt
                        />
                        <p>Car Model: {{ car.model }}</p>
                        <p>Car Make: {{ car.make }}</p>
                        <p>Price: ${{ car.price}}</p>
                        <p>Year: {{ car.year }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      carMakeSelected: "",
      carMakes: [],
      cars: null,
    };
  },
  watch: {
    carMakeSelected: function (make) {
      console.log(make);
      this.listOnlyMakeSelected(make);
    },
  },
  mounted() {
    this.getCars();
  },
  methods: {
    getCars() {
      const self = this;
      fetch("/api/cars")
        .then((res) => res.json())
        .then((res) => {
          self.cars = res.data;
          $.each(res.data, function (key, value) {
            self.carMakes.push(value.make);
          });
          self.carMakes = [...new Set(this.carMakes)];
        })
        .catch((err) => console.log(err));
    },
    listOnlyMakeSelected(make) {
      const self = this;
      fetch(`/api/cars/${make}`)
        .then((res) => res.json())
        .then((res) => {
          self.cars = null;
          self.cars = res.data;
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>
