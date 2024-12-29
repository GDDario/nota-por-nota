import 'package:flutter/material.dart';

sealed class AppColors {
  static const Color blue1 = Color(0xFF0AB2F3);
  static const Color blue2 = Color(0xFF43C9FD);
  static const Color blue3 = Color(0xFF73D8FF);
  static const Color blue4 = Color(0xFFA9E7FF);
  static const Color green1 = Color(0xFF46D5B3);
  static const Color green2 = Color(0xFF83E1CB);
  static const Color green3 = Color(0xFFA4EAD9);
  static const Color green4 = Color(0xFFC5F1E7);
  static const Color red1 = Color(0xFFF3595C);
  static const Color red2 = Color(0xFFF56F72);
  static const Color red3 = Color(0xFFF99395);
  static const Color red4 = Color(0xFFF4B5B7);
  static const Color white1 = Color(0xFFFFFFFF);
  static const Color dorian1 = Color(0xFFECF1F4);

  static const lightColorScheme = ColorScheme(
    brightness: Brightness.light,
    primary: AppColors.blue1,
    onPrimary: AppColors.white1,
    secondary: AppColors.blue1,
    onSecondary: AppColors.white1,
    error: AppColors.white1,
    onError: AppColors.red1,
    surface: AppColors.white1,
    onSurface: Colors.black,
  );
}
