import java.util.Arrays;
import java.util.Scanner;

public class ProblemSolving1 {
    public static void main(String[] args) {

        try (Scanner scanner = new Scanner(System.in)) {
            System.out.println("Masukkan 5 angka pisahkan dengan koma: ");
            String input = scanner.nextLine();
            String[] values = input.split(",");

            int[] arr = new int[5];

            for (int i = 0; i < 5; i++) {
                arr[i] = Integer.parseInt(values[i].trim());
            }

            manualSort(arr);

            for (int i = 0; i < arr.length; i++) {
                if (arr[i] < 1 || arr[i] > Math.pow(10, 9)) {
                    System.out.println("Error: Constraints not met for array element at index " + i);
                    return;
                }
            }

            int minSum = arr[0] + arr[1] + arr[2] + arr[3];
            int maxSum = arr[1] + arr[2] + arr[3] + arr[4];

            System.out.println("Array: " + Arrays.toString(arr));
            System.out.println("Min Sum of 4 integers: " + minSum);
            System.out.println("Max Sum of 4 integers: " + maxSum);

            scanner.close();
        } catch (NumberFormatException e) {
            System.out.println("Harus masukkan angka! \n");
            e.printStackTrace();
        }
    }

    private static void manualSort(int[] arr) {
        int n = arr.length;
        for (int i = 0; i < n - 1; i++) {
            for (int j = 0; j < n - i - 1; j++) {
                if (arr[j] > arr[j + 1]) {
                    int temp = arr[j];
                    arr[j] = arr[j + 1];
                    arr[j + 1] = temp;
                }
            }
        }
    }
}