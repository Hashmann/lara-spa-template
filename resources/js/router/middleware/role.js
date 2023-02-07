export default function role({ next, store }) {
  console.log('GET_AUTH_USER', store.getters["GET_AUTH_USER"].user)
  if (store.getters["GET_AUTH_USER"]) next()
  else next({ name: "error" });
}
