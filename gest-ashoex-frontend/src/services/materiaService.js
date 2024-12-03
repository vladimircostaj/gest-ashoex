const API_URL = "http://localhost:8000/api";

const fetchMaterias = async () => {
  const response = await fetch(`${API_URL}/materias`, 
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  ); 

  return response.json();
};

const materiaService = {
  fetchMaterias,
};

export default materiaService;