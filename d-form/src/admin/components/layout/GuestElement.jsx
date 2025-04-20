import { Outlet } from "react-router-dom";
import { useAuth } from "./AuthContext"
import { Navigate } from "react-router-dom";

// NOTE
// Act as middleware for routes that don`t need authentication.
// Redirect user to dashboard if user already logged in
const GuestElement=()=>{
    const {isLoggedIn} = useAuth();
    return !isLoggedIn ? <Outlet /> : <Navigate to="/admin/dashboard" replace={true} />
}
export default GuestElement