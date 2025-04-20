import { createContext, useState, useContext, useCallback, useMemo } from "react"
import { useNavigate } from "react-router-dom";
const AuthContext = createContext({});

/* 
	`AuthProvider` AS ROUTE WRAPPER
	 Provide authentication, authorization and credentials`s  properties and methods
     for Admin pages.
*/
export const AuthProvider=({children})=>{
    const [token, setToken] = useState("");
    const [user, setUser] = useState({});

    const login=useCallback(async (event)=>{
        event.preventDefault();
        const baseURL = import.meta.env.VITE_API_URL;
        const apiURL = `${baseURL}/login`;
    
        const formData = new FormData(event.target)
        const jsonBody = Object.fromEntries(formData)
        console.log(jsonBody);
    
        const response = await fetch(apiURL, {
            mode: "cors",
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(jsonBody)
        })
    
        let result;
        let _token;
        let userData;

        switch(response.status)
        {
            case 200 :
                result = await response.json();
                _token = result.data.access_token;
                userData = result.data.user;
        
                setUser(userData);
                setToken(_token);
                break;
        }
    }, [])
    const logout=async (e)=>{
        e.preventDefault();
        const baseURL = import.meta.env.VITE_API_URL;
        const apiURL = `${baseURL}/login`;
    
        const formData = new FormData(e.target)
        const jsonBody = Object.fromEntries(formData)
    
        const response = await fetch(apiURL, {
            mode: "cors",
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(jsonBody)
        })
    
        
        switch(response.status)
        {
            case 200 :
                // result = await response.json();
                setUser([]);
                setToken("");
                break;
        }
    }
    const isLoggedIn=useMemo(()=>{
        return (Object.keys(user || {})?.length)&&token?.length;
    }, [token, user])

    console.log(user);
    return (
        <AuthContext.Provider value={{ token, user, login, logout, isLoggedIn }}>
            {children}
        </AuthContext.Provider>
    )
}
export const useAuth=()=>useContext(AuthContext);