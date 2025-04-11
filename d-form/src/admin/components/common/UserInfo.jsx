import React from "react";

function UserInfo({ username, email }) {
  return (
    <div className="p-3 m-3 flex items-center rounded-md bg-white/10">
      {/* Avatar */}
      <div className="w-10 h-10 bg-gray-200 rounded-md mr-3 flex-shrink-0"></div>

      {/* Username & Email (Tersusun ke Bawah dan Tidak Melebar) */}
      <div className="flex flex-col flex-grow w-0">
        <p className="font-medium">{username}</p>
        <p className="text-xs text-gray-300 break-all w-full">{email}</p>
      </div>

      {/* Menu Button */}
      <button className="mx-auto">⋮</button>
    </div>
  );
}

export default UserInfo;
