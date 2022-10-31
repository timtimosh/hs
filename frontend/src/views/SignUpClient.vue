<template>
  <main class="w-100 m-auto form-signin">
    <div class="alert alert-danger" v-show="alertMessage !== null">
      {{ alertMessage }}
    </div>
    <form @submit="Submit" autocomplete="on">
      <img class="mb-4 brand-logo" src="@/assets/img/brand.png" alt="brand">
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <div class="form-floating">
        <input type="text" class="form-control" v-model="form.userName" id="userName" placeholder="Your name" required>
        <label for="userName">Name</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" v-model="form.userSurname" id="userSurname" placeholder="Your surname">
        <label for="userSurname">Surname</label>
      </div>

      <div class="form-floating">
        <input type="email" class="form-control" id="userEmail" v-model="form.userEmail" @input="ValidateEmail"
               placeholder="name@example.com"
               required>
        <label for="userEmail">Email address</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" v-model="form.userPassword" id="userPassword" placeholder="Password"
               required>
        <label for="userPassword">Password</label>
      </div>
      <div class="form-floating">
        <input type="password" minlength="6" class="form-control" id="confirmUserPassword"
               @input="ValidateConfirmPassword" v-model="form.userConfirmPassword"
               placeholder="Confirm Password" required>
        <label for="confirmUserPassword">Confirm Password</label>
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit" :disabled=isSubmitDisabled>Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
  </main>
</template>

<script>
export default {
  data () {
    return {
      form: {
        userName: '',
        userSurname: '',
        userEmail: '',
        userPassword: '',
        userConfirmPassword: ''
      },
      alertMessage: null,
      loading: false,
      submitting: false,
      notValidFieldClass: 'field-not-valid'
    };
  },
  computed: {
    isSubmitDisabled () {
      return this.form.userPassword !== this.form.userConfirmPassword
          || !this.form.userPassword
          || !this.form.userEmail
          || !this.form.userName;
    }
  },
  methods: {
    ValidateEmail (evt) {
      let input = evt.target;
      let value = input.value;
      if (value !== ''
          && !/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
        input.classList.add(this.notValidFieldClass);
      } else {
        input.classList.remove(this.notValidFieldClass);
      }
    },
    ValidateConfirmPassword (evt) {
      let input = evt.target;
      let value = input.value;
      if (this.form.userPassword !== '' && value !== '' && value !== this.form.userPassword) {
        input.classList.add(this.notValidFieldClass);
      } else {
        input.classList.remove(this.notValidFieldClass);
      }
    },
    Submit (event) {
      event.preventDefault();
      this.submitting = true;
      this.axios.post('/api/user', this.form).then((response) => {
        this.userName = '';
        this.userSurname = '';
        this.userEmail = '';
        this.userPassword = '';
        this.userConfirmPassword = '';
        this.submitting = false;
        this.alertMessage = null;
        this.$router.push('/signUpClientOk');
      }).catch(function (error) {
        let errorStringtify = JSON.stringify(error);
        console.log(errorStringtify);
        this.alertMessage = 'ooops';
      });
    }
  }

};
</script>