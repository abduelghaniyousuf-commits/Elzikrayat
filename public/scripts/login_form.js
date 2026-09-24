
import { bcrypt } from "https://cdn.jsdelivr.net/gh/dcodeIO/bcrypt.js@3.0.3/index.js";

alert("working");
console.log("working");

const form = document.querySelector("form");

form.addEventListener("submit", async (event) => {
  event.preventDefault();
  event.stopImmediatePropagation();
  console.log(event.type);
  console.log(event.target);
  const body = new FormData(form);
  await hash(body.get("password"));

  console.log(hash);

  // sendData();

})


async function hash(password) {
  const salt = bcrypt.genSaltySync(10);
  const hash = bcrypt.hashSync(password, salt);
  console.log(hash);
}


async function sendData() {
  try {
    var res = await fetch(
      "/login", {
      method: "POST",
      body: body
    }
    );
    console.log(await res.json());
  } catch (e) {
    console.error(e);
  }
}