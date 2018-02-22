<template>
  <div>
    <span class="text-capitalize">{{ item.nama_menu }}</span>
    <abbr class="text-capitalize">{{ item.jenis_menu }} ~ Rp {{ item.harga | formatNumber }}</abbr>
  </div>
</template>

<script>
export default {
  props: {
    item: { required: true },
    searchText: { required: true }
  }
}
</script>