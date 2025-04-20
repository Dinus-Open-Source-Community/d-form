import { Outlet } from "react-router-dom";
import { useAuth } from "./AuthContext"
import { Navigate } from "react-router-dom";

// NOTE
// Act as middleware for routes that need authentication. 
// Redirect user to login page if IsLoggedIn false
const AuthElement=()=>{
    const {isLoggedIn,user} = useAuth();
    return isLoggedIn&&user.role==='admin' ? <Outlet /> : <Navigate to="/admin/login" replace={true} />
}
export default AuthElement