import axios from "axios";

export const getListaPersonal = async () => {
  const response = await axios.get(
    "http://localhost:8000/api/personal-academicos"
  );

  return response.data;
};

