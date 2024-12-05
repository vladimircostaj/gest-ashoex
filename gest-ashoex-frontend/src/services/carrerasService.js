const API_BASE_URL = "http://localhost:8000/api";

const fetchCarreraStatus = async () => {
   try {
      const response = await fetch(`${API_BASE_URL}/carreras`);
      console.log(response);

      if (!response.ok) {
         // Si la respuesta no es OK, manejamos errores específicos
         if (response.status === 404) {
            // Error 404 con un mensaje claro
            throw new Error("No se encontraron carreras. Por favor, agrega una carrera.");
         } else {
            // Otros errores genéricos
            throw new Error(`${response.status} ${response.statusText}`);
         }
      }

      const data = await response.json();

      if (!data.success) {
         // Control de errores del backend, traducimos el mensaje de error
         throw new Error(data.message || "Error desconocido del servidor");
      }

      return data.data; // Retornamos solo el arreglo "data"
   } catch (error) {
      // Log del error para desarrollo y re-lanzamos para manejarlo en el componente
      console.error("Error al obtener las carreras:", error.message);
      throw error;
   }
};

const carrerasService = {
   fetchCarreraStatus,
};

export default carrerasService;
