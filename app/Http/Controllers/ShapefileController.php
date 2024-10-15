<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Register autoloader

use Shapefile\ShapefileReader;
use Shapefile\ShapefileException;
use Illuminate\Http\JsonResponse;


class ShapefileController extends Controller
{
    public function extractCoordinates(): JsonResponse
    {
        // try {
        //     // Path to your .shp file
        //     $shapefilePath = public_path('documents/DISTRICT_BOUNDARY.shp');
        //     //dd($shapefilePath);
        //   //  public_path('documents/Proceduresforapplicants.pdf');

        //     // Create a new ShapefileReader
        //     $shapefile = new ShapefileReader($shapefilePath);
        //     dd($shapefile);
        //     // Initialize an array to store coordinates
        //     $coordinates = [];

        //     // Loop through all shapes in the shapefile
        //     foreach ($shapefile as $feature) {
        //         $geometry = $feature->getGeometry();
        //         $type = $geometry->getType();

        //         if ($type === 'Point') {
        //             $coordinates[] = [
        //                 'type' => 'Point',
        //                 'coordinates' => [$geometry->getX(), $geometry->getY()],
        //             ];
        //         } elseif ($type === 'Polygon') {
        //             $coords = [];
        //             foreach ($geometry->getCoordinates() as $point) {
        //                 $coords[] = [$point->getX(), $point->getY()];
        //             }
        //             $coordinates[] = [
        //                 'type' => 'Polygon',
        //                 'coordinates' => $coords,
        //             ];
        //         }
        //         // You can add handling for other geometry types (e.g., LineString) if needed
        //     }

        //     // Return the coordinates as JSON response
        //     return response()->json($coordinates);

        // } catch (ShapefileException $e) {
        //     // Handle errors
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
        $shapefilePath = public_path('documents/DISTRICT_BOUNDARY.shp');

        try {
            // Open the shapefile
            $Shapefile = new ShapefileReader($shapefilePath);
            
            // Read and process the file
            while ($Geometry = $Shapefile->fetchRecord()) {
                if ($Geometry->isDeleted()) {
                    continue;
                }
        
                // Output geometry data
                print_r($Geometry->getArray());
            }
            
        } catch (ShapefileException $e) {
            // Capture the shapefile-specific error
            return response()->json(['error' => $e->getErrorType() . ': ' . $e->getMessage()]);
        } catch (\Exception $e) {
            // Capture generic PHP errors
            return response()->json(['error' => 'General error: ' . $e->getMessage()]);
        }


        try {
            // Define the path to the shapefile (change this to the actual file path)
            $shapefilePath = public_path('documents/DISTRICT_BOUNDARY.shp');

            if (!file_exists($shapefilePath)) {
                return response()->json(['error' => 'File does not exist at the specified path']);
            }
            
            if (!is_readable($shapefilePath)) {
                return response()->json(['error' => 'File is not readable']);
            }

            if (file_exists($shapefilePath)) {
                try {
                    $fileContents = file_get_contents($shapefilePath);
                    return response()->json(['success' => 'File is readable', 'content_length' => strlen($fileContents)]);
                } catch (\Exception $e) {
                    return response()->json(['error' => 'File exists but could not be read', 'message' => $e->getMessage()]);
                }
            } else {
                return response()->json(['error' => 'File does not exist']);
            }
            dd($shapefilePath);
            // Open Shapefile
            $Shapefile = new ShapefileReader($shapefilePath);
          
            // Create an array to hold all geometry and data
            $shapefileData = [];

            // Read all the records
            while ($Geometry = $Shapefile->fetchRecord()) {
                // Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                // Collect the geometry and associated data
                $shapefileData[] = [
                    'geometry_array' => $Geometry->getArray(),  // Geometry as an array
                    'geometry_wkt' => $Geometry->getWKT(),      // Geometry as WKT
                    'geometry_geojson' => $Geometry->getGeoJSON(),  // Geometry as GeoJSON
                    'dbf_data' => $Geometry->getDataArray(),    // DBF data
                ];
            }

            // Return the data as a JSON response
            return response()->json($shapefileData);

        } catch (ShapefileException $e) {
            // Handle errors (e.g., if the file is not found or readable)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
