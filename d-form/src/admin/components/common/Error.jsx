const NotFound=()=>(
    <div className="flex flex-col items-center justify-center text-center p-8 bg-white rounded-xl border border-gray-200 shadow-sm">
        <img 
        src="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/icons/package.svg" 
        alt="No data" 
        className="w-20 h-20 mb-4 opacity-50"
        />
        <h3 className="text-lg font-semibold text-gray-700 mb-2">No Data Found</h3>
        <p className="text-sm text-gray-500">Looks like there's nothing here yet.</p>
    </div>
)
export default NotFound