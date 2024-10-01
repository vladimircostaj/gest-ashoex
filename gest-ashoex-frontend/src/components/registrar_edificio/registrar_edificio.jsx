import { useForm } from "react-hook-form";
import "./registrar_edificio.css";

function RegistrarEdificio() {
  const { register, handleSubmit, formState: { errors } } = useForm();

  const onSubmit = (data) => {
    console.log(data);
    console.log(errors);
  }

  return (
    <div className="form">
      <form onSubmit={handleSubmit(onSubmit)}>
        <div className="input-group">
          <label htmlFor="nombreEdificio">Nombre del edificio:</label>
          <input
            id="nombreEdificio"
            name="nombreEdificio"
            type="text"
            {...register("nombreEdificio", { required: true })}
            aria-invalid={errors.nombreEdificio ? "true" : "false"}
          />
          {errors.nombreEdificio?.type === "required" && (
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
  );
}

export default RegistrarEdificio;

