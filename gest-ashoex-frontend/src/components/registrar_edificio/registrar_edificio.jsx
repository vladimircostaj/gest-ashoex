import { useForm } from "react-hook-form";
import "./registrar_edificio.css";
import { registrarEdificio } from "../../services/edificiosService";

function RegistrarEdificio() {
  const { register, handleSubmit, formState: { errors } } = useForm();

  const onSubmit = (data) => {
    registrarEdificio(data);
  }

  return (
    <div>
      <div><h2>Registrar Edificio</h2></div>

      <div className="form">
        <form onSubmit={handleSubmit(onSubmit)}>
          <div className="input-group">
            <label htmlFor="nombreEdificio">Nombre del edificio:</label>
            <input
              id="nombreEdificio"
              name="nombreEdificio"
              type="text"
              {...register("nombre_edificio", { required: true })}
              aria-invalid={errors.nombre_edificio ? "true" : "false"}
            />
            {errors.nombre_edificio?.type === "required" && (
              <p className="error-message" role="alert">¡Debe ingresar el nombre del edificio!</p>
            )}
          </div>
          <div className="input-group">
            <label htmlFor="geolocalizacion">Geolocalizaci&oacute;n:</label>
            <input
              id="geolocalizacion"
              name="geolocalizacion"
              {...register("geolocalizacion", { required: true })}
              aria-invalid={errors.geolocalizacion ? "true" : "false"}
            />
            {errors.geolocalizacion?.type === "required" && (
              <p className="error-message" role="alert">¡Debe ingresar la geolocalizaci&oacute;n!</p>
            )}
          </div>
          <button type="submit">Registrar</button> 
        </form>
      </div>
    </div>
  );
}

export default RegistrarEdificio;

