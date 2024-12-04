const API_URL = "http://127.0.0.1:8000"; 

const fetchMaterias = async () => {
  const response = await fetch(`${API_URL}/api/materias`, 
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  ); 
  const data = await response.json(); 
  
  return data;
};

const materiaService = {
  fetchMaterias,
};

export default materiaService;
