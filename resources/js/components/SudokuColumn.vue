<template>
  <input type="text" :readonly="readonly" :class="`sudoku-column ${error ? 'error' : ''} ${readonly ? 'readonly' : ''}`" v-model="value"/>
</template>

<script>
  export default {
    name: "SudokuColumn",
    props: ['val', 'error', 'readonly'],
    data() {
      return {
        value: this.val
      };
    },
    watch: {
      value(val) {
        this.$emit('input', val);
      },
    }
  };
</script>

<style lang="scss" scoped>
  .sudoku-column {
    height: 60px;
    width: 60px;
    border: black solid 1px;
    text-align: center;
  }

  .error {
    background: darksalmon;
  }

  .readonly {
    background: gainsboro;
  }
</style>
