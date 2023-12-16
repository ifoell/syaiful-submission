import java.util.Arrays;
import java.util.Scanner;

public class ProblemSolving2 {
    public static void main(String[] args) {

        try (Scanner scanner = new Scanner(System.in)) {

            System.out.print("Masukkan ukuran array : ");
            String arrSize = scanner.nextLine();
            int n = Integer.parseInt(arrSize);

            if(n < 0 || n > 100){
                System.out.println("Ukuran Array harus di antara 0 sampai dengan 100!");
                return;
            }

            System.out.println("Masukkan "+n+" angka pisahkan dengan koma: ");
            String input = scanner.nextLine();
            String[] values = input.split(",");

            int[] arr = new int[n];

            for (int i = 0; i < n; i++) {
                arr[i] = Integer.parseInt(values[i].trim());
            }

            int positiveCount = 0;
            int negativeCount = 0;
            int zeroCount = 0;

            for (int num : arr) {
                if (num > 0) {
                    positiveCount++;
                } else if (num < 0) {
                    negativeCount++;
                } else {
                    zeroCount++;
                }
            }

            Double positivDouble = Double.valueOf(positiveCount);
            Double negativDouble = Double.valueOf(negativeCount);
            Double zerDouble = Double.valueOf(zeroCount);

            String positive = String.format("%.6f",Double.valueOf(positivDouble/n));
            String negative = String.format("%.6f",Double.valueOf(negativDouble/n));
            String zero = String.format("%.6f",Double.valueOf(zerDouble/n));

            System.out.println("Array: " + Arrays.toString(arr));
            System.out.println("Positive Numbers: " + positive);
            System.out.println("Negative Numbers: " + negative);
            System.out.println("Zero Numbers: " + zero);

            scanner.close();
        } catch (NumberFormatException e) {
            System.out.println("Harus masukkan angka! \n");
            e.printStackTrace();
        }
    }
}
