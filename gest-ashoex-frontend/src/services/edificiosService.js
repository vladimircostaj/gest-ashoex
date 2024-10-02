const API_URL = 'http://localhost:8000/api';

export const registrarEdificio = async (requestBody) => {
  await fetch(`${API_URL}/edificios`, {
    method: 'POST',
    body: JSON.stringify(requestBody),
    headers: { "Content-type": "application/json; charset=UTF-8" }
  })
  .then(response => response.json())
  .then(json => console.log(json))
  .catch(err => console.log(err));
};

export const obtenerEdificios = async () => {
  return await fetch(`${API_URL}/edificios`)
    .then(response => response.json())
    .then(data => {
      return data;
    })
    .catch(err => console.log(err));
}

