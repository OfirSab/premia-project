<template class="main">
  <div class="container col-md-4 align-items-center main">
    <form @submit.prevent="sendData">
      <div class="card">
        <div class="card-header">Premia Status</div>
        <div class="card-body">
          <div class="form-group">
            <label for="name">Full Name</label>

            <input
              type="text"
              class="form-control"
              id="name"
              v-model="details.name.value"
              required
              placeholder="Enter Full name"
            />
            <small class="text-danger" v-if="details.name.error"
              >Invalid Name</small
            >
          </div>
          <div class="form-group">
            <label>Phone Number</label>

            <input
              type="text"
              class="form-control"
              id="phone"
              required
              v-model="details.phone.value"
              placeholder="Phone Number"
            />
            <small class="text-danger" v-if="details.phone.error"
              >Invalid phone number</small
            >
          </div>
          <div class="form-group">
            <label for="email">Email address</label>

            <input
              type="text"
              class="form-control"
              id="email"
              required
              v-model="details.email.value"
              placeholder="Enter email"
            />
            <small class="text-danger" v-if="details.email.error"
              >Invalide email address</small
            >
          </div>
          <div class="form-group">
            <label>Id number</label>
            <input
              type="password"
              class="form-control"
              id="id"
              required
              v-model="details.id.value"
              placeholder="Enter Id number"
            />
            <small class="text-danger" v-if="details.id.error"
              >invalid id number</small
            >
          </div>
          <button
            type="submit"
            @click="validate"
            class="btn btn-primary mt-3"
            id="send-btn"
            name="submit"
          >
            Send
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Premia",
  data() {
    return {
      details: {
        name: { value: null, error: false },
        phone: { value: null, error: false },
        email: { value: null, error: false },
        id: { value: null, error: false },
      },
      premiaSum: 0,
    };
  },
  methods: {
    authName() {
      const regex = RegExp("^([a-zA-Z]{2,}) ([a-zA-Z]{2,})");
      if (!regex.test(this.details.name.value)) this.details.name.error = true;
      else {
        this.details.name.error = false;
      }
    },
    authPhone() {
      const regex = RegExp("^[0-9-+]{7,10}$");
      if (!regex.test(this.details.phone.value))
        this.details.phone.error = true;
      else {
        this.details.phone.error = false;
      }
    },
    authEmail() {
      const regex = RegExp("[a-zA-Z0-9-+]{1,30}@[a-z]{2,10}.[a-z]{1,7}");
      if (!regex.test(this.details.email.value))
        this.details.email.error = true;
      else {
        this.details.email.error = false;
      }
    },
    authId() {
      const regex = RegExp("^((0[1-9][1-9])|([1-9][1-9][1-9])){3}$");
      if (!regex.test(this.details.id.value)) this.details.id.error = true;
      else {
        this.details.id.error = false;
      }
    },
    clear() {
      if (
        !this.details.name.error &&
        !this.details.phone.error &&
        !this.details.email.error &&
        !this.details.id.error
      ) {
        this.sendData();
        this.details.name.value = "";
        this.details.phone.value = "";
        this.details.email.value = "";
        this.details.id.value = "";
      }
    },
    async sendData() {
      const res = await this.calApi("post", "api/data", {
        fullName: this.details.name.value,
        phone: this.details.phone.value,
        email: this.details.email.value,
        id: this.details.id.value,
      });
      if (res.status === 200) {
        Object.keys(res.data.hbJson).forEach((key) => {
          if (Array.isArray(res.data.hbJson[key])) {
            for (var i = 0; i < res.data.hbJson[key].length; i++) {
              this.premiaSum += parseFloat(res.data.hbJson[key][i].premia);
            }
          }
        });
        if (this.premiaSum > 50) {
          const re = await this.calApi("post", "api/aboveFifty", {
            fullName: this.details.name.value,
            phone: this.details.phone.value,
            email: this.details.email.value,
            id: this.details.id.value,
          });
        } else {
          const re = await this.calApi("post", "api/underFifty", {
            fullName: this.details.name.value,
            phone: this.details.phone.value,
            email: this.details.email.value,
            id: this.details.id.value,
          });
        }
        alert("פרטיך נשלחו בהצלחה!");
      } else {
        alert(res.data.errmsg);
      }
    },
    calApi(method, url, dataObj) {
      try {
        return axios({
          method: method,
          url: url,
          data: dataObj,
        });
      } catch (e) {
        return alert("error");
      }
    },

    validate() {
      event.preventDefault();
      this.authName();
      this.authPhone();
      this.authEmail();
      this.authId();
      this.clear();
    },
  },
};
</script>
<style scoped>
</style>


