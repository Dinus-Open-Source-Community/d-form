import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const SignUpForm = () => {
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const navigate = useNavigate();

  return (
    <div className="flex min-h-screen">
      {/* Left side - Dark background */}
      <div className="w-3/5 bg-[#343434]"></div>

      {/* Right side - Sign up form */}
      <div className="w-2/5 bg-white p-2 flex-col justify-center">
        {/* Logo and title */}
        <div className="mx-8 mt-4 mb-10">
          <div className="flex items-center">
            <span className="text-4xl font-bold">D</span>
            <span className="ml-2 text-2xl">DOSCOM FORM</span>
          </div>
        </div>

        <div className="max-w-md mx-auto w-96">
          {/* Form */}
          <div className="mt-12">
            <h2 className="text-3xl font-bold text-center mb-8">Sign Up</h2>

            <form>
              <div className="mb-6">
                <label htmlFor="email" className="block mb-2">
                  E-Mail
                </label>
                <input
                  type="email"
                  id="email"
                  placeholder="emailexample@gmail.com"
                  className="w-full px-4 py-3 border-2 border-[#343434] rounded-xl"
                />
              </div>

              {/* Password Field (Tanpa Icon) */}
              <div className="mb-6">
                <label htmlFor="password" className="block mb-2">
                  Password
                </label>
                <input
                  type="password"
                  id="password"
                  className="w-full px-4 py-3 border-2 border-[#343434] rounded-xl"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                />
              </div>

              {/* Confirm Password Field (Tanpa Icon) */}
              <div className="mb-8">
                <label htmlFor="confirmPassword" className="block mb-2">
                  Confirm Password
                </label>
                <input
                  type="password"
                  id="confirmPassword"
                  className="w-full px-4 py-3 border-2 border-[#343434] rounded-xl"
                  value={confirmPassword}
                  onChange={(e) => setConfirmPassword(e.target.value)}
                />
              </div>

              <div className="mb-6">
                <button
                  type="submit"
                  onClick={() => navigate("/admin/login")}
                  className="w-full bg-[#343434] text-white py-3 rounded-xl font-medium hover:bg-gray-800"
                >
                  Sign Up
                </button>
              </div>

              <div className="text-center relative my-6">
                <div className="absolute top-1/2 left-0 right-0 h-px bg-[#343434]"></div>
                <span className="relative bg-white px-4 text-sm text-[#343434]">
                  Or sign up with
                </span>
              </div>

              <div className="flex justify-center mb-8">
                <button className="border-2 border-[#343434] rounded-xl p-2 flex items-center justify-center w-16 h-10 hover:bg-gray-300">
                  <span className="text-3xl font-bold">G</span>
                </button>
              </div>
            </form>
          </div>
        </div>
        <div className="mx-8 mt-20 ">
          <span className="text-xs">Have an account? </span>
          <a href="/admin/login" className="text-xs font-bold">
            Login
          </a>
        </div>
      </div>
    </div>
  );
};

export default SignUpForm;
