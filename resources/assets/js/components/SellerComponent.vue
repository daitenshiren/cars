<template>
  <div id="seller-cars" class="uk-child-width-expand@s uk-text-center" uk-grid>
    <div>
      <div class="uk-card uk-card-small uk-card-body">
        <fieldset class="uk-fieldset">
          <div class="uk-card uk-card-default uk-card-body">
            <h3 class="uk-card-title">Add Car Information</h3>

            <div class="uk-margin">
              <input
                class="uk-input"
                type="text"
                placeholder="Please type in the car make"
                v-model="car.make"
              />
            </div>
            <div class="uk-margin">
              <input
                class="uk-input"
                type="text"
                placeholder="Please type in the car model"
                v-model="car.model"
              />
            </div>
            <div class="uk-margin">
              <input
                class="uk-input"
                type="number"
                placeholder="Please type in the car price"
                v-model="car.price"
              />
            </div>
            <div class="uk-margin">
              <select class="uk-select" name id v-model="car.year">
                <option value>Please select car year model</option>
                <option v-for="year in years" :key="year">{{ year }}</option>
              </select>
            </div>
            <div class="uk-margin">
              <button
                class="uk-button uk-button-primary uk-align-right"
                @click="addCarInfo()"
              >Add Car Information</button>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
    <div>
      <div class="uk-card uk-card-small uk-card-body">
        <div class="uk-margin">
          <p v-if="!cars">There are no car information yet.</p>
          <div v-else>
            <legend class="uk-legend">Car Listing</legend>
            <div v-for="car in cars" :key="car.id">
              <div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
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
          <!-- <select class="uk-select" name id v-model="carMakeSelected">
                <option
                  v-for="make in carMake"
                  :key="make.id"
                  v-bind:value="make.id"
                >{{ make.make }}</option>
          </select>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      car: {
        make: "",
        year: "",
        model: "",
        price: "",
      },
      cars: null,
    };
  },
  mounted() {
    this.getCars();
  },
  computed: {
    years() {
      const year = new Date().getFullYear();
      return Array.from(
        { length: year - 1900 },
        (value, index) => 1901 + index
      );
    },
  },
  watch: {
    carMakeSelected: function (data) {
      if (data === "others") this.others = true;
    },
  },
  methods: {
    getCars() {
      const self = this;
      fetch("/api/cars")
        .then((res) => res.json())
        .then((res) => {
          self.cars = res.data;
        })
        .catch((err) => console.log(err));
    },
    addCarInfo() {
      let self = this;

      fetch("api/car", {
        method: "POST",
        body: JSON.stringify(this.car),
        headers: {
          "content-type": "application/json",
        },
      })
        .then((res) => res.json())
        .then((data) => {
          if (confirm("Successfully Added Car Information.")) {
            self.cancelled();
            self.getCars();
          }
        })
        .catch((err) => console.log(err));
    },
    cancelled() {
      this.car.model = "";
      this.car.make = "";
      this.car.year = "";
      this.car.price = "";

      this.btnUpdate = false;
      this.btnAdd = true;
      this.btnCancel = false;
    },
  },
};
</script>

<style lang="scss">
</style>
