const BonesCard=()=>(
  <div className="bg-white rounded-xl shadow-md overflow-hidden cursor-default animate-pulse">
    <div className="h-36 sm:h-40 md:h-48 bg-gray-300"></div>

    <div className="p-3 sm:p-4 border-x-2 border-b-2 rounded-b-xl border-gray-400">
      <div className="flex flex-wrap gap-1 sm:gap-2 mb-2">
        <span className="inline-block h-5 w-20 bg-gray-300 rounded-lg"></span>
        {/* Add more category tags if needed */}
      </div>

      <div className="h-4 bg-gray-300 rounded w-3/4 mb-2"></div>
      <div className="h-3 bg-gray-300 rounded w-full mb-1"></div>
      <div className="h-3 bg-gray-300 rounded w-5/6 mb-3"></div>
      <div className="h-3 bg-gray-300 rounded w-1/3"></div>
    </div>
  </div>
)
export default BonesCard